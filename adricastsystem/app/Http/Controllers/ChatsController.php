<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Chat;
use App\Models\User;
use App\Models\Modulo;
use App\Models\Rol;
use App\Models\Seccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatsController extends Controller
{
    //
protected $rutaConcat;
    public function __construct()
    {
        $this->middleware('auth');
        $this->rutaConcat = config('app.ruta_concat');
    }
public function index()
{ 
    $authUserId = Auth::id();
    $typeUser = auth()->user()->typeUser;
    $user = Auth::user();
    $descripcion = $typeUser ? $typeUser->descripcion : 'No asignado';
    $moduloIds = Rol::where('estado', 1)->pluck('id_modulos')->unique();
    $modulos = Modulo::whereIn('id', $moduloIds)->get();

    // Obtener los usuarios con los que se ha tenido conversación (mensajes visibles para authId)
    $chatUsers = Chat::selectRaw("CASE WHEN sender_id = ? THEN receiver_id ELSE sender_id END as other_user_id", [$authUserId])
        ->where(function ($query) use ($authUserId) {
            $query->where(function ($q) use ($authUserId) {
                $q->where('sender_id', $authUserId)->where('visible_sender', 1);
            })->orWhere(function ($q) use ($authUserId) {
                $q->where('receiver_id', $authUserId)->where('visible_receiver', 1);
            });
        })
        ->distinct()
        ->pluck('other_user_id');

    // Calcular mensajes no leídos por usuario (donde el usuario autenticado es receptor y status = 'no_leido')
    $unreadCounts = Chat::select('sender_id', \DB::raw('COUNT(*) as unread_count'))
        ->where('receiver_id', $authUserId)
        ->where('status', 'no_leido')
        ->where('visible_receiver', 1)
        ->groupBy('sender_id')
        ->pluck('unread_count', 'sender_id')
        ->toArray();

    $userMessages = collect();

    foreach ($chatUsers as $otherUserId) {
        $lastMessage = Chat::where(function ($query) use ($authUserId, $otherUserId) {
            $query->where('sender_id', $authUserId)
                  ->where('receiver_id', $otherUserId)
                  ->where('visible_sender', 1);
        })->orWhere(function ($query) use ($authUserId, $otherUserId) {
            $query->where('sender_id', $otherUserId)
                  ->where('receiver_id', $authUserId)
                  ->where('visible_receiver', 1);
        })
        ->orderBy('created_at', 'desc')
        ->first();

        if ($lastMessage) {
            $userMessages[$otherUserId] = [
                'user' => User::find($otherUserId),
                'last_message' => $lastMessage->message,
                'timestamp' => $lastMessage->created_at->format('Y-m-d H:i:s'),
                'unread_count' => $unreadCounts[$otherUserId] ?? 0,  // Aquí se añade el contador de mensajes no leídos
            ];
        }
    }
    $secciones = Seccion::all();
       
    return view('reikosoft.chats.index', compact('descripcion', 'modulos', 'userMessages', 'user', 'unreadCounts','secciones'));
}


// ChatController.php

   public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'username' => 'required|string',
        'mensaje' => 'required|string',
    ]);

    // Obtener el ID del usuario receptor a partir del nombre de usuario
    $receiver = User::where('username', $request->username)->first();

    // Verificar si el usuario receptor existe
    if ($receiver) {
        // Crear un nuevo mensaje
        $chat = new Chat();
        $chat->sender_id = auth()->id(); // ID del remitente (usuario autenticado)
        $chat->receiver_id = $receiver->id; // ID del receptor
        $chat->message = $request->mensaje; // Mensaje enviado
        $chat->status = 'no_leido'; // Establecer el estado como "no_leído"
        $chat->sent_at = Carbon::now(); // Establecer la fecha y hora de envío actual

        $chat->save();

        // Retornar una respuesta JSON con éxito
        return response()->json([
            'success' => true,
            'message' => 'El mensaje se ha enviado correctamente.'
        ]);
    } else {
        // El usuario receptor no existe
        return response()->json([
            'success' => false,
             'message' => "El usuario receptor '{$request->username}' no existe."
        ]);
    }
}

  public function show($userId)
{
    $authUserId = Auth::id();

    $mensajes = Chat::where(function ($query) use ($authUserId, $userId) {
            $query->where('sender_id', $authUserId)
                  ->where('receiver_id', $userId)
                  ->where('visible_sender', 1);   // solo si visible para el sender
        })
        ->orWhere(function ($query) use ($authUserId, $userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $authUserId)
                  ->where('visible_receiver', 1); // solo si visible para el receiver
        })
        ->orderBy('created_at', 'asc')
        ->get();

    foreach ($mensajes as $mensaje) {
        $mensaje->tipo = ($mensaje->sender_id == $authUserId) ? 'enviado' : 'recibido';
    }

    return response()->json($mensajes);
}
public function ocultarConversacion($userId)
{
    try {
        $authUserId = Auth::id();

        // Ocultar todos los mensajes enviados por mí a ese usuario (visible_sender = false)
        Chat::where('sender_id', $authUserId)
            ->where('receiver_id', $userId)
            ->update(['visible_sender' => false]);

        // Ocultar todos los mensajes recibidos de ese usuario (visible_receiver = false)
        Chat::where('sender_id', $userId)
            ->where('receiver_id', $authUserId)
            ->update(['visible_receiver' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Conversación oculta correctamente para el usuario autenticado.'
        ]);
    } catch (\Exception $e) {
        // Captura cualquier error inesperado
        return response()->json([
            'success' => false,
            'message' => 'No se pudo ocultar la conversación.',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function contadorNoLeidos($id)
{
    try {
        $receiverId = Auth::id(); // Usuario autenticado (receptor)
        $senderId = $id; // Este es el id que se pasa en la URL

        $contador = Chat::where('receiver_id', $receiverId)
                           ->where('sender_id', $senderId)
                           ->where('leido', false)
                           ->count();

        return response()->json([
            'contador' => $contador
        ]);
    } catch (\Exception $e) {
        \Log::error('Error en contadorNoLeidos: ' . $e->getMessage());

        return response()->json([
            'error' => 'Ocurrió un error al obtener el contador.'
        ], 500);
    }
}



    public function deleteConversation($userId)
{
    $authUserId = Auth::id();

    // Validar que el usuario existe para evitar problemas
    $user = User::find($userId);
    if (!$user) {
        return response()->json(['error' => 'Usuario no encontrado.'], 404);
    }

    // Eliminar todos los mensajes entre el usuario autenticado y el usuario $userId
    Chat::where(function ($query) use ($authUserId, $userId) {
        $query->where('sender_id', $authUserId)->where('receiver_id', $userId);
    })->orWhere(function ($query) use ($authUserId, $userId) {
        $query->where('sender_id', $userId)->where('receiver_id', $authUserId);
    })->delete();

    return response()->json(['success' => 'Conversación eliminada correctamente.']);
}
public function destroyMessage($id)
{
    try {
        $authUserId = Auth::id();
        // Buscar el mensaje que tenga el id y que haya sido enviado por el usuario autenticado
        $mensaje = Chat::where('id', $id)
                       ->where('sender_id', $authUserId)
                       ->firstOrFail();

        $mensaje->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mensaje eliminado correctamente.'
        ]);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // El mensaje no existe o no pertenece al usuario autenticado
        return response()->json([
            'success' => false,
            'message' => 'No tienes permiso para eliminar este mensaje o no existe.'
        ], 403);
    } catch (\Exception $e) {
        // Otro error
        return response()->json([
            'success' => false,
            'message' => 'No se pudo eliminar el mensaje.',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function ocultarMensajeEnviado($id)
{
    try {
        $authUserId = Auth::id();

        // Buscar el mensaje enviado por el usuario autenticado
        $mensaje = Chat::where('id', $id)
                       ->where('sender_id', $authUserId)
                       ->firstOrFail();

        // Marcar como oculto para el emisor
        $mensaje->visible_sender = false;
        $mensaje->save();

        return response()->json([
            'success' => true,
            'message' => 'Mensaje ocultado para ti (emisor).'
        ]);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'success' => false,
            'message' => 'No tienes permiso o el mensaje no existe.'
        ], 403);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'No se pudo ocultar el mensaje.',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function ocultarMensajeRecibido($id)
{
    try {
        $authUserId = Auth::id();

        $mensaje = Chat::where('id', $id)
                       ->where('receiver_id', $authUserId)  // quien recibe
                       ->firstOrFail();

        $mensaje->visible_receiver = false;
        $mensaje->save();

        return response()->json([
            'success' => true,
            'message' => 'Mensaje ocultado para receptor correctamente.'
        ]);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'success' => false,
            'message' => 'No tienes permiso para ocultar este mensaje o no existe.'
        ], 403);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'No se pudo ocultar el mensaje.',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function marcarLeidos($userId)
{
    $authUserId= Auth::id();

    // Solo mensajes recibidos por el usuario actual y enviados por userId
    $actualizados = Chat::where('sender_id', $userId)
        ->where('receiver_id', $authUserId)
        ->where('status', 'no_leido')
        ->update(['status' => 'leido']);

    return response()->json([
        'success' => true,
        'message' => "$actualizados mensajes marcados como leídos"
    ]);
}
public function contadorConversaciones()
{
    $authUserId = Auth::id();

    $unreadCounts = Chat::select('sender_id', \DB::raw('COUNT(*) as unread_count'))
        ->where('receiver_id', $authUserId)
        ->where('status', 'no_leido')
        ->where('visible_receiver', 1)
        ->groupBy('sender_id')
        ->pluck('unread_count', 'sender_id')
        ->toArray();

    return response()->json($unreadCounts);
}



}

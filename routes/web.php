<?php

use App\Events\ChatMessageEvent;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'users' => User::whereNot('id', Auth::user()->id)->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // User Routes
    Route::get('/chat/{friend}', function (User $friend) {
        return Inertia::render('Chat', [
            'friend' => $friend
        ]);
    })->name('chat');

    Route::get('/messages/{friend}', function (User $friend) {
        return ChatMessage::query()
            ->where(function ($query) use ($friend) {
                $query->where('sender_id', auth()->id())
                    ->where('receiver_id', $friend->id);
            })
            ->orWhere(function ($query) use ($friend) {
                $query->where('sender_id', $friend->id)
                    ->where('receiver_id', auth()->id());
            })
            ->with('sender', 'receiver')
            ->orderBy('id', 'asc')
            ->get();
    });

    Route::post('/messages/{friend}', function (User $friend) {
        $message = ChatMessage::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $friend->id,
            'message' => request('message')
        ]);

        broadcast(new ChatMessageEvent($message));

        return response()->json([
            'message' => $message
        ]);
    });

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

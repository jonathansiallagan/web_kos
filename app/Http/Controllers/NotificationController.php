<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Khusus untuk Admin (URL: /admin/notifications)
     */
    public function adminIndex()
    {
        $notifications = Auth::user()->notifications;
        // Return view khusus admin
        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Khusus untuk User (URL: /user/notifications)
     */
    public function userIndex()
    {
        $notifications = Auth::user()->notifications;
        // Return view khusus user
        return view('user.notifications.index', compact('notifications'));
    }

    // 2. Menandai semua notifikasi sebagai "Sudah Dibaca"
    public function markAllRead()
    {
        // Ubah auth()->user() jadi Auth::user()
        Auth::user()->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }
}

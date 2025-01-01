<?php

namespace App\Http\Controllers;
use App\Models\ModulPembelajaran;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan ini
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    /**
     * Display icons page
     *
     * @return \Illuminate\View\View
     */
    public function icons()
    {
        return view('admin.pages.icons');
    }

    /**
     * Display maps page
     *
     * @return \Illuminate\View\View
     */
    public function maps()
    {
        return view('admin.pages.maps');
    }

    /**
     * Display tables page
     *
     * @return \Illuminate\View\View
     */
    public function tables()
    {
        return view('admin.pages.tables');
    }

    /**
     * Display notifications page
     *
     * @return \Illuminate\View\View
     */
    public function notifications()
    {
        return view('admin.pages.notifications');
    }

    /**
     * Display rtl page
     *
     * @return \Illuminate\View\View
     */
    public function rtl()
    {
        return view('admin.pages.rtl');
    }

    /**
     * Display typography page
     *
     * @return \Illuminate\View\View
     */
    public function typography()
    {
        return view('admin.pages.typography');
    }

    /**
     * Display upgrade page
     *
     * @return \Illuminate\View\View
     */
    public function upgrade()
    {
        return view('admin.pages.upgrade');
    }

    public function modulPembelajaran()
    {
        $ModulPembelajaran = ModulPembelajaran::all();
        return view('admin.pages.Modul_Pembelajaran.modulPembelajaran', [
            'ModulPembelajaran' => $ModulPembelajaran,
        ]);
    }

    public function buatModul()
    {
        return view('admin.pages.Modul_Pembelajaran.createModul');
    }
    public function createModul(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'title' => 'required|string|max:32',
            'description' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
            'slug' => 'unique:modul_pembelajaran,slug' // Validasi unik
        ]);

        // Handle file upload
        $filePath = $request->file('file') ? $request->file('file')->store('modul_pembelajaran', 'public') : null;

        // Handle image upload
        $imagePath = $request->file('image') ? $request->file('image')->store('modul_images', 'public') : null;

        // Save the data in the database
        ModulPembelajaran::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file' => $filePath,  // Simpan path file
            'image' => $imagePath, // Simpan path gambar
            'slug' => $this->createSlug($validated['title']),
        ]);

        return redirect()->route('admin.modulPembelajaran')->with('success', 'Modul berhasil diupload!');
    }

    public function editModul($id)
    {
        // Cari modul berdasarkan ID
        $modul = ModulPembelajaran::findOrFail($id);

        // Tampilkan halaman edit
        return view('admin.pages.Modul_Pembelajaran.edit', compact('modul'));
    }

    // Fungsi untuk membuat slug unik
    public function createSlug($title)
    {
        $slug = Str::slug($title); // Membuat slug dasar
        $existingSlugs = ModulPembelajaran::where('slug', 'LIKE', "$slug%")
            ->pluck('slug'); // Ambil slug yang mirip

        // Tambahkan angka jika slug sudah ada
        $counter = 1;
        $originalSlug = $slug;
        while ($existingSlugs->contains($slug)) {
            $slug = "$originalSlug-" . $counter++;
        }

        return $slug;
    }

    // Fungsi untuk memperbarui modul
    public function updateModul(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Temukan modul berdasarkan ID
        $modul = ModulPembelajaran::findOrFail($id);

        // Cek apakah ada file yang diunggah
        if ($request->hasFile('file')) {
            if ($modul->file) {
                Storage::disk('public')->delete($modul->file);
            }
            $filePath = $request->file('file')->store('modul_pembelajaran', 'public');
            $modul->file = $filePath;
        }

        // Cek apakah ada gambar yang diunggah
        if ($request->hasFile('image')) {
            if ($modul->image) {
                Storage::disk('public')->delete($modul->image);
            }
            $imagePath = $request->file('image')->store('modul_images', 'public');
            $modul->image = $imagePath;
        }

        // Update data lainnya
        $modul->title = $validated['title'];
        $modul->description = $validated['description'];
        $modul->save();

        return redirect()->route('admin.modulPembelajaran')->with('success', 'Modul berhasil diperbarui!');
    }

    // Halaman daftar event (index)
    public function eventAnnouncement()
    {
        $events = Event::all();
        return view('admin.pages.Event_Announcement.eventAnnouncement', ['events' => $events]);
    }

    // Halaman buat event
    public function buatEvent()
    {
        return view('admin.pages.Event_Announcement.createEvent');
    }

    // Proses simpan event baru
    public function simpanEvent(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'mentor' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'unique:events,slug'
        ]);

        // Upload gambar jika ada
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('event_images', 'public');
        }

        // Membuat slug
        $slug = Str::slug($validated['nama']);
        $slugExists = Event::where('slug', $slug)->exists();

        if ($slugExists) {
            $slug = "{$slug}-" . time();
        }

        // Menyimpan data event ke database
        Event::create([
            'nama' => $validated['nama'],
            'mentor' => $validated['mentor'],
            'lokasi' => $validated['lokasi'],
            'waktu_mulai' => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
            'gambar' => $gambarPath,
            'slug' => $slug,
        ]);

        return redirect()->route('admin.eventAnnouncement')->with('success', 'Event berhasil ditambahkan!');
    }

    // Halaman edit event
    public function editEvent($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.pages.Event_Announcement.editEvent', ['event' => $event]);
    }

    // Proses update event baru
    public function updateEvent(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'mentor' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Temukan event berdasarkan ID
        $event = Event::findOrFail($id);

        // Upload gambar baru jika ada
        $gambarPath = $event->gambar;
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($gambarPath && Storage::disk('public')->exists($gambarPath)) {
                Storage::disk('public')->delete($gambarPath);
            }
            $gambarPath = $request->file('gambar')->store('event_images', 'public');
        }

        // Update event
        $event->update([
            'nama' => $validated['nama'],
            'mentor' => $validated['mentor'],
            'lokasi' => $validated['lokasi'],
            'waktu_mulai' => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin.eventAnnouncement')->with('success', 'Event berhasil diperbarui!');
    }

    // Proses delete event
    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);

        // Hapus gambar jika ada
        if ($event->gambar && Storage::disk('public')->exists($event->gambar)) {
            Storage::disk('public')->delete($event->gambar);
        }

        // Hapus event dari database
        $event->delete();

        return redirect()->route('admin.eventAnnouncement')->with('success', 'Event berhasil dihapus!');
    }

    // CRUD User Below

    public function userManagement()
    {
        $users = User::all();
        return view('admin.pages.User_Management.userManagement', ['users' => $users]);
    }

    // Halaman buat event
    public function buatUser()
    {
        return view('admin.pages.User_Management.createUser');
    }

    // Proses simpan event baru
    public function simpanUser(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email|max:255|unique:user',
            'name' => 'required|string|max:32',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,mentor,admin',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('image_path', 'public');
        }

        // Menyimpan data event ke database
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'image_path' => $validated['image_path'],
        ]);

        return redirect()->route('admin.userManagement')->with('success', 'User berhasil ditambahkan!');
    }

    // Halaman edit event
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pages.User_Management.edit', ['user' => $user]);
    }

    // Proses update user baru
    public function updateUser(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:32',
            'role' => 'required|in:user,mentor,admin',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);

        // Upload gambar baru jika ada
        $imagePath = $user->image_path;
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('user_images', 'public');
        }

        // Update event
        $user->update([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'image_path' => $validated['image_path'],
        ]);

        return redirect()->route('admin.userManagement')->with('success', 'User berhasil diperbarui!');
    }

    // Proses delete user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Hapus gambar jika ada
        if ($user->gambar && Storage::disk('public')->exists($user->image_path)) {
            Storage::disk('public')->delete($user->image_path);
        }

        // Hapus user dari database
        $user->delete();

        return redirect()->route('admin.userManagement')->with('success', 'User berhasil dihapus!');
    }
}
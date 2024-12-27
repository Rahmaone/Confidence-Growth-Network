<?php

namespace App\Http\Controllers;
use App\Models\ModulPembelajaran;
use App\Models\Event;
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
            $modul = ModulPembelajaran::findOrFail(id: $id); // Cari modul berdasarkan ID
            return view('admin.pages.Modul_Pembelajaran.editModul', compact('modul')); // Tampilkan halaman edit
        }

        // Fungsi untuk membuat slug unik
        public function createSlug($title)
        {
            $slug = Str::slug($title); // Membuat slug dasar
            $existingSlugs = ModulPembelajaran::where('slug', 'LIKE', "{$slug}%")->pluck('slug'); // Ambil slug yang mirip

            // Tambahkan angka jika slug sudah ada
            $counter = 1;
            $originalSlug = $slug;
            while ($existingSlugs->contains($slug)) {
                $slug = "{$originalSlug}-" . $counter++;
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
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            ]);

            // Temukan modul berdasarkan ID
            $modul = ModulPembelajaran::findOrFail($id);

            // Cek apakah ada file yang diunggah
            if ($request->hasFile('file')) {
                if ($modul->file) {
                    Storage::disk('public')->delete($modul->file);
                }
                $filePath = $request->file('file')->store('modul_pembelajaran', 'public');
                $modul->update(['file' => $filePath]);
            }

            // Cek apakah ada gambar yang diunggah
            if ($request->hasFile('image')) {
                if ($modul->image) {
                    Storage::disk('public')->delete($modul->image);
                }
                $imagePath = $request->file('image')->store('modul_images', 'public');
                $modul->update(['image' => $imagePath]);
            }

            // Update data lainnya
            $modul->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
            ]);

            return redirect()->route('admin.modulPembelajaran')->with('success', 'Modul berhasil diperbarui!');
        }

        // Fungsi untuk menghapus modul
        public function deleteModul($id)
        {
            $modul = ModulPembelajaran::findOrFail($id);

            // Hapus file dari storage jika ada
            if ($modul->file) {
                Storage::disk('public')->delete($modul->file);
            }

            // Hapus gambar dari storage jika ada
            if ($modul->image) {
                Storage::disk('public')->delete($modul->image);
            }

            // Hapus modul dari database
            $modul->delete();

            return redirect()->route('admin.modulPembelajaran')->with('success', 'Modul berhasil dihapus!');
        }
    
    // Halaman daftar event (index)
    public function eventAnnouncement()
    {
        $events = Event::all();
        return view('admin.pages.Event_Announcement.eventAnnoucement', ['events' => $events]);
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
}
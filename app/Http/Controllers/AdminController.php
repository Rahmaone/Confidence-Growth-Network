<?php

namespace App\Http\Controllers;
use App\Models\ModulPembelajaran;
use Illuminate\Http\Request;
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
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240', // File validation
        ]);

        // Handle the file upload
        if ($request->hasFile('file')) {
            // Get the uploaded file
            $file = $request->file('file');

            // Store the file in the 'modul_pembelajaran' folder on the 'public' disk
            $filePath = $request->file('file')->store('modul_pembelajaran', 'public');


            // Save the data in the database including the file path
            ModulPembelajaran::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'file' => $filePath,  // Store the file path in the database
            ]);

            // Redirect or return a response
            return redirect()->route('admin.modulPembelajaran')->with('success', 'Modul berhasil diupload!');
        }

        // If no file uploaded, return an error message
        return redirect()->back()->with('error', 'File gagal diupload');
    }
}

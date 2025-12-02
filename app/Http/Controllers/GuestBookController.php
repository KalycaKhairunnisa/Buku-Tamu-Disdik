<?php

namespace App\Http\Controllers;

use App\Models\GuestBook;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestBookController extends Controller
{
    public function index(Request $request)
    {
        $query = GuestBook::query();

        // Filter berdasarkan kecamatan
        if ($request->filled('kecamatan')) {
            $query->where('kecamatan_id', $request->kecamatan);
        }

        // Filter berdasarkan nama pengambil
        if ($request->filled('nama_pengambil')) {
            $query->where('nama_pengambil', 'like', '%' . $request->nama_pengambil . '%');
        }

        // Filter berdasarkan nama TK/KB
        if ($request->filled('nama_tk_kb')) {
            $query->where('nama_tk_kb', 'like', '%' . $request->nama_tk_kb . '%');
        }

        $guestBooks = $query->with(['kecamatan','user'])->latest()->paginate(10);
        $kecamatan = Kecamatan::orderBy('nama')->get();

        return view('guest-books.index', compact('guestBooks', 'kecamatan'));
    }

    public function create()
    {
        $kecamatan = Kecamatan::orderBy('nama')->get();
        return view('guest-books.create', compact('kecamatan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'nama_pengambil' => 'required|string|max:255',
            'nama_tk_kb' => 'required|string|max:255',
            'tanda_tangan' => 'required|string',
        ]);

        // Populate legacy `kecamatan` string column for compatibility
        $kecamatanModel = Kecamatan::find($validated['kecamatan_id']);
        $legacyKecamatan = $kecamatanModel?->nama ?? null;

        $data = array_merge($validated, [
            'user_id' => Auth::id(),
            'kecamatan' => $legacyKecamatan,
        ]);

        GuestBook::create($data);

        return redirect()->route('guest-books.index')->with('success', 'Data berhasil disimpan. Terima kasih.');
    }

    public function exportPdf(Request $request)
    {
        $query = GuestBook::query();

        if ($request->filled('kecamatan')) {
            $query->where('kecamatan_id', $request->kecamatan);
        }

        if ($request->filled('nama_pengambil')) {
            $query->where('nama_pengambil', 'like', '%' . $request->nama_pengambil . '%');
        }

        if ($request->filled('nama_tk_kb')) {
            $query->where('nama_tk_kb', 'like', '%' . $request->nama_tk_kb . '%');
        }

        $guestBooks = $query->with(['kecamatan','user'])->latest()->get();

        // Generate simple HTML response for PDF
        $html = $this->generatePdfContent($guestBooks);

        return response($html)
            ->header('Content-Type', 'text/html; charset=utf-8')
            ->header('Content-Disposition', 'attachment; filename="buku-tamu-' . date('Y-m-d') . '.html"');
    }

    public function exportExcel(Request $request)
    {
        $query = GuestBook::query();

        if ($request->filled('kecamatan')) {
            $query->where('kecamatan_id', $request->kecamatan);
        }

        if ($request->filled('nama_pengambil')) {
            $query->where('nama_pengambil', 'like', '%' . $request->nama_pengambil . '%');
        }

        if ($request->filled('nama_tk_kb')) {
            $query->where('nama_tk_kb', 'like', '%' . $request->nama_tk_kb . '%');
        }

        $guestBooks = $query->with(['kecamatan','user'])->latest()->get();

        // Generate CSV content
        $csv = $this->generateCsvContent($guestBooks);

        return response($csv)
            ->header('Content-Type', 'text/csv; charset=utf-8')
            ->header('Content-Disposition', 'attachment; filename="buku-tamu-' . date('Y-m-d') . '.csv"');
    }

    private function getKecamatan()
    {
        return Kecamatan::orderBy('nama')->get();
    }

    private function generatePdfContent($guestBooks)
    {
        $html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Buku Tamu Dinas Pendidikan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 10px; text-align: left; }
        th { background-color: #ADD8E6; font-weight: bold; }
        h1 { text-align: center; color: #4a90e2; }
    </style>
</head>
<body>
    <h1>Laporan Buku Tamu Dinas Pendidikan</h1>
    <p>Tanggal Cetak: ' . date('d-m-Y H:i:s') . '</p>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Kecamatan</th>
                <th>Nama Pengambil</th>
                <th>Nama TK/KB</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>';

        foreach ($guestBooks as $index => $book) {
            $kecamatanName = $book->kecamatan?->nama ?? $book->kecamatan_id ?? '-';
            $html .= '<tr>
                <td>' . ($index + 1) . '</td>
                <td>' . $kecamatanName . '</td>
                <td>' . $book->nama_pengambil . '</td>
                <td>' . $book->nama_tk_kb . '</td>
                <td>' . $book->created_at->format('d-m-Y H:i') . '</td>
            </tr>';
        }

        $html .= '</tbody>
    </table>
</body>
</html>';

        return $html;
    }

    private function generateCsvContent($guestBooks)
    {
        $csv = "No.,Kecamatan,Nama Pengambil,Nama TK/KB,Tanggal\n";

        foreach ($guestBooks as $index => $book) {
            $kecamatanName = $book->kecamatan?->nama ?? $book->kecamatan_id ?? '-';
            $csv .= ($index + 1) . ','
                . '"' . addslashes($kecamatanName) . '",'
                . '"' . addslashes($book->nama_pengambil) . '",'
                . '"' . addslashes($book->nama_tk_kb) . '",'
                . '"' . $book->created_at->format('d-m-Y H:i') . '"' . "\n";
        }

        return $csv;
    }
}


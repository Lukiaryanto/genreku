<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FuzzyConfig;
use Illuminate\Http\Request;

class FuzzyConfigController extends Controller
{
    public function index()
    {
        $membership = FuzzyConfig::where('group', 'membership')->orderBy('id')->get();
        $output     = FuzzyConfig::where('group', 'output')->orderBy('id')->get();
        $threshold  = FuzzyConfig::where('group', 'threshold')->orderBy('id')->get();

        return view('admin.fuzzy_config', [
            'title'      => 'Pengaturan Fuzzy',
            'membership' => $membership,
            'output'     => $output,
            'threshold'  => $threshold,
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'configs'        => 'required|array',
            'configs.*.id'   => 'required|exists:fuzzy_configs,id',
            'configs.*.value'=> 'required|numeric',
        ]);

        foreach ($data['configs'] as $item) {
            FuzzyConfig::where('id', $item['id'])->update(['value' => $item['value']]);
        }

        return redirect()->route('admin.fuzzy_config.index')
            ->with('success', 'Konfigurasi Fuzzy berhasil diperbarui.');
    }
}

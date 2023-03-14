<?php

namespace App\Http\Controllers;

use App\Models\CamConfig;
use Illuminate\Http\Request;

class CamConfigController extends Controller
{
    public function saveConfig(Request $request, $type)
    {
        $hueMin = $request->hueMin;
        $hueMax = $request->hueMax;
        $satMin = $request->satMin;
        $satMax = $request->satMax;
        $valMin = $request->valMin;
        $valMax = $request->valMax;

        $config = CamConfig::where('type', $type)->first();
        if ($config) {
            $config->hueMin = $hueMin;
            $config->hueMax = $hueMax;
            $config->satMin = $satMin;
            $config->satMax = $satMax;
            $config->valMin = $valMin;
            $config->valMax = $valMax;
            $config->save();
        } else {
            $config = new CamConfig();
            $config->type = $type;
            $config->hueMin = $hueMin;
            $config->hueMax = $hueMax;
            $config->satMin = $satMin;
            $config->satMax = $satMax;
            $config->valMin = $valMin;
            $config->valMax = $valMax;
            $config->save();
        }
        return response()->json([
            'message' => 'success',
        ]);
    }

    public function GetConfig($type)
    {
        $config = CamConfig::where('type', $type)->first();
        return response()->json($config);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the settings.
     */
    public function index()
    {
        $settings = Setting::orderBy('group')
            ->orderBy('key')
            ->paginate(15);

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new setting.
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * Store a newly created setting in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255|unique:settings,key',
            'value' => 'required',
            'type' => 'required|in:string,integer,boolean,json',
            'group' => 'nullable|string|max:255',
        ]);

        // Handle type conversion
        $value = $validated['value'];
        if ($validated['type'] === 'boolean') {
            $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        } elseif ($validated['type'] === 'integer') {
            $value = (int) $value;
        } elseif ($validated['type'] === 'json') {
            // Validate JSON
            json_decode($value);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', __('admin.invalid_json'));
            }
        }

        Setting::create([
            'key' => $validated['key'],
            'value' => $value,
            'type' => $validated['type'],
            'group' => $validated['group'] ?? 'general',
        ]);

        return redirect()->route('admin.settings.index')
            ->with('success', __('admin.created_successfully', ['resource' => __('admin.setting')]));
    }

    /**
     * Show the form for editing the specified setting.
     */
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified setting in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255|unique:settings,key,' . $setting->id,
            'value' => 'required',
            'type' => 'required|in:string,integer,boolean,json',
            'group' => 'nullable|string|max:255',
        ]);

        // Handle type conversion
        $value = $validated['value'];
        if ($validated['type'] === 'boolean') {
            $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        } elseif ($validated['type'] === 'integer') {
            $value = (int) $value;
        } elseif ($validated['type'] === 'json') {
            // Validate JSON
            json_decode($value);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', __('admin.invalid_json'));
            }
        }

        $setting->update([
            'key' => $validated['key'],
            'value' => $value,
            'type' => $validated['type'],
            'group' => $validated['group'] ?? 'general',
        ]);

        return redirect()->route('admin.settings.index')
            ->with('success', __('admin.updated_successfully', ['resource' => __('admin.setting')]));
    }

    /**
     * Remove the specified setting from storage.
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return redirect()->route('admin.settings.index')
            ->with('success', __('admin.deleted_successfully', ['resource' => __('admin.setting')]));
    }
}

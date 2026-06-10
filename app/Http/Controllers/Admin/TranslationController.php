<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TranslationController extends Controller
{
    public function __construct()
    {
    }

    public function showEditLang()
    {
        $langFiles = File::files(base_path('lang/en'));
        return view('admin.translation.index', compact('langFiles'));
    }

    public function loadFileData(Request $request)
    {
        $englishSelectedLangFile = base_path('lang/en/' .  $request->input('langFile'));
        $arabicSelectedLangFile = base_path('lang/ar/' .  $request->input('langFile'));

        $arabicLangData = include($arabicSelectedLangFile);
        $englishLangData = include($englishSelectedLangFile);

        $langFiles = File::files(base_path('lang/en'));
        return view('admin.translation.index', compact('langFiles', 'arabicSelectedLangFile', 'englishSelectedLangFile', 'arabicLangData', 'englishLangData'));
    }

    public function saveLangFile(Request $request)
    {
        $selectedLangFile = $request->input('langFile');


        $newLangData = $request->except('_token', 'langFile');

        // Write an empty array to the file
        file_put_contents($selectedLangFile, "<?php\n\nreturn [];\n");

        // Get the existing data
        $existingLangData = include $selectedLangFile;

        // Merge new data with existing data
        $updatedLangData = array_merge($existingLangData, $newLangData);

        // Prepare the content for the file
        $fileContent = "<?php\n\nreturn [\n";
        foreach ($updatedLangData as $key => $value) {
            $fileContent .= "    '$key' => '$value',\n";
        }
        $fileContent .= "];\n";

        // Write the updated content to the file
        file_put_contents($selectedLangFile, $fileContent);

        return redirect()->route('admin.translation.loadFileData', ['langFile' => basename($selectedLangFile)])
            ->with('success', 'Language file updated successfully!');
    }

    public function addTranslation(Request $request)
    {
        $englishSelectedLangFile = base_path('lang/en/' .  $request->input('langFile'));
        $arabicSelectedLangFile = base_path('lang/ar/' .  $request->input('langFile'));

        $key = $request->input('key');
        $englishValue = $request->input('englishValue');
        $arabicValue = $request->input('arabicValue');

        $arabicLangData = include($arabicSelectedLangFile);
        $englishLangData = include($englishSelectedLangFile);

        $englishLangData[$key] = $englishValue;
        $arabicLangData[$key] = $arabicValue;

        $englishFileContent = "<?php\n\nreturn " . var_export($englishLangData, true) . ";\n";
        $arabicFileContent = "<?php\n\nreturn " . var_export($arabicLangData, true) . ";\n";

        file_put_contents($englishSelectedLangFile, $englishFileContent);
        file_put_contents($arabicSelectedLangFile, $arabicFileContent);

        return redirect()->route('admin.translation.loadFileData', ['langFile' => basename($englishSelectedLangFile)])
            ->with('success', 'Language file updated successfully!');
    }
}

<?php

namespace Modules\Language\app\Http\Controllers;

use App\Enums\RedirectType;
use App\Http\Controllers\Controller;
use App\Traits\RedirectHelperTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use Modules\Language\app\Enums\AllCountriesDetailsEnum;
use Modules\Language\app\Enums\SyncLanguageType;
use Modules\Language\app\Http\Requests\LanguageRequest;
use Modules\Language\app\Models\Language;
use Modules\Language\app\Traits\LanguageTrait;
use Modules\Language\app\Traits\SyncModelsTrait;

class LanguageController extends Controller
{
    use LanguageTrait, RedirectHelperTrait, SyncModelsTrait;

    public function index(): View
    {
        abort_unless(checkAdminHasPermission('language.view'), 403);
        Paginator::useBootstrap();
        $languages = Language::paginate(15);

        return view('language::index', [
            'languages' => $languages,
        ]);
    }

    public function create(): View
    {
        abort_unless(checkAdminHasPermission('language.create'), 403);
        $all_languages = AllCountriesDetailsEnum::getLanguages();

        return view('language::create', compact('all_languages'));
    }

    public function store(LanguageRequest $request): RedirectResponse
    {
        abort_unless(checkAdminHasPermission('language.store'), 403);
        $language = Language::create($request->validated());

        if ($language && $request->hasFile('icon')) {
            $file_name = file_upload($request->icon, $language->icon, 'uploads/custom-images/');
            $language->icon = $file_name;
            $language->save();
        }

        if ($language) {
            $code = $language->code;
            $parentDir = dirname(app_path());

            $sourcePath = $parentDir . '/lang/en.json';
            $destinationPath = $parentDir . "/lang/{$code}.json";

            if (File::exists($sourcePath) && !File::exists($destinationPath)) {
                $jsonData = File::get($sourcePath);
                File::put($destinationPath, $jsonData);
            }
        }

        $this->syncModels(SyncLanguageType::CREATE->value, boolval(SyncLanguageType::isQueueable()), $language->code);

        return $this->redirectWithMessage(
            RedirectType::CREATE->value,
            'admin.languages.index',
        );
    }

    public function edit(Language $language): View
    {
        abort_unless(checkAdminHasPermission('language.edit'), 403);
        $all_languages = AllCountriesDetailsEnum::getLanguages();

        return view('language::edit', compact('language', 'all_languages'));
    }

    public function update(LanguageRequest $request, Language $language): RedirectResponse
    {
        abort_unless(checkAdminHasPermission('language.update'), 403);
        $oldCode = $language->code;
        $language->update($request->validated());

        if ($language && $request->hasFile('icon')) {
            $file_name = file_upload($request->icon, $language->icon, 'uploads/custom-images/');
            $language->icon = $file_name;
            $language->save();
        }
        $code = $language->code;

        if ($language && ($oldCode !== $code) && ($code !== 'en')) {
            $parentDir = dirname(app_path());

            $sourcePath = $parentDir . '/lang/en.json';
            $destinationPath = $parentDir . "/lang/{$code}.json";

            if (File::exists($sourcePath) && !File::exists($destinationPath)) {
                $jsonData = File::get($sourcePath);
                File::put($destinationPath, $jsonData);
            }

            if ($oldCode !== $code && $code !== 'en') {
                $destinationPath = $parentDir . "/lang/{$oldCode}.json";
                try {
                    File::delete($destinationPath);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }

        $this->syncModels(SyncLanguageType::UPDATE->value, boolval(SyncLanguageType::isQueueable()), $language->code, $oldCode);

        return $this->redirectWithMessage(
            RedirectType::UPDATE->value,
            'admin.languages.index',
        );
    }

    public function destroy(Language $language): RedirectResponse
    {
        abort_unless(checkAdminHasPermission('language.delete'), 403);
        if ($language->id == 1) {
            return $this->redirectWithMessage(
                RedirectType::ERROR->value,
                'admin.languages.index',
            );
        }

        $code = $language->code;
        if ($code == app()->getLocale() || $code == 'en') {
            return $this->redirectWithMessage(
                RedirectType::ERROR->value,
                'admin.languages.index',
            );
        }

        if ($language->icon) {
            if (File::exists(public_path($language->icon))) {
                unlink(public_path($language->icon));
            }
        }

        if ($code !== 'en' && $deleted = $language->delete()) {
            $destinationPath = dirname(app_path()) . "/lang/{$code}.json";
            File::delete($destinationPath);
        }

        if ($deleted) {
            $this->syncModels(SyncLanguageType::DELETE->value, boolval(SyncLanguageType::isQueueable()), $code);
        }

        return $this->redirectWithMessage(
            RedirectType::DELETE->value,
            'admin.languages.index',
        );
    }

    public function updateStatus(Language $language): JsonResponse
    {
        abort_unless(checkAdminHasPermission('language.update'), 403);

        if (request('column') == 'is_default') {
            Language::where('is_default', 1)->update(['is_default' => 0]);
            $isDefault = $language->is_default ? 0 : 1;
            $language->is_default = $isDefault;
        } elseif (request('column') == 'status') {
            $status = $language->status ? 0 : 1;
            $language->status = $status;
        }
        $action = $language->save();

        return response()->json([
            'status' => $action,
            'message' => $action ? __('Language Updated Successfully!') : __('Language Updating Failed!'),
        ]);
    }
}

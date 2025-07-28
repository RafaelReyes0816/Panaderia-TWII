<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('not_empty_string', function ($attribute, $value, $parameters, $validator) {
            return !empty(trim($value));
        }, 'El campo :attribute no puede estar vacío.');

        Validator::extend('valid_phone', function ($attribute, $value, $parameters, $validator) {
            if (empty($value)) return true;
            return preg_match('/^[0-9\-\+\(\)\s]{7,20}$/', $value);
        }, 'El campo :attribute debe ser un número de teléfono válido.');

        Validator::extend('positive_price', function ($attribute, $value, $parameters, $validator) {
            return is_numeric($value) && $value > 0;
        }, 'El campo :attribute debe ser mayor a 0.');

        Validator::extend('non_negative_stock', function ($attribute, $value, $parameters, $validator) {
            return is_numeric($value) && $value >= 0;
        }, 'El campo :attribute no puede ser negativo.');

        Validator::extend('unique_name', function ($attribute, $value, $parameters, $validator) {
            $table = $parameters[0];
            $column = $parameters[1] ?? 'nombre';
            $ignoreId = $parameters[2] ?? null;
            
            $query = DB::table($table)->where($column, trim($value));
            
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
            
            return !$query->exists();
        }, 'Ya existe un registro con este nombre.');

        Validator::extend('valid_address', function ($attribute, $value, $parameters, $validator) {
            if (empty($value)) return true;
            return strlen(trim($value)) >= 5;
        }, 'El campo :attribute debe tener al menos 5 caracteres.');
    }
}

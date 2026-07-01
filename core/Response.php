<?php

class Response
{
    /**
     * Respuesta exitosa
     */
    public static function success(
        string $message,
        $data = null
    ): array
    {
        return [
            'success' => true,
            'message' => $message,
            'data'    => $data
        ];
    }

    /**
     * Respuesta de error
     */
    public static function error(
        string $message,
        $errors = null
    ): array
    {
        return [
            'success' => false,
            'message' => $message,
            'errors'  => $errors
        ];
    }
}
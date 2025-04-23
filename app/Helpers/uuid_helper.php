<?php

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if (!function_exists('generate_uuid')) {
    /**
     * Generate a UUID (version 4)
     * 
     * @return string
     */
    function generate_uuid(): string
    {
        try {
            return Uuid::uuid4()->toString();
        } catch (UnsatisfiedDependencyException $e) {
            // Handle the exception if needed
            log_message('error', 'UUID generation failed: ' . $e->getMessage());
            throw $e;
        }
    }
}

if (!function_exists('is_valid_uuid')) {
    /**
     * Check if a string is a valid UUID
     * 
     * @param string $uuid
     * @return bool
     */
    function is_valid_uuid(string $uuid): bool
    {
        try {
            Uuid::fromString($uuid);
            return true;
        } catch (\InvalidArgumentException $e) {
            return false;
        }
    }
} 
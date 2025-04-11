<?php
namespace App\DTO;

use Illuminate\Http\Request;

class LoginDTO
{
    public function __construct(
        public string $email,
        public string $password
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            email: $request->input('email'),
            password: $request->input('password')
        );
    }
}

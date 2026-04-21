<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    protected string $apiKey;
    protected string $baseUrl;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('services.openai.key', env('OPENAI_API_KEY'));
        $this->baseUrl = config('services.openai.base_url', 'https://api.openai.com/v1');
        $this->model = config('services.openai.model', 'gpt-3.5-turbo');
    }

    public function chat(array $messages)
    {
        if (empty($this->apiKey)) {
            return ['error' => 'API Key não configurada.'];
        }

        try {
            // Remove barras finais da URL para evitar duplicidade //
            $baseUrl = rtrim($this->baseUrl, '/');

            $response = Http::withToken($this->apiKey)
                ->timeout(30)
                ->post("{$baseUrl}/chat/completions", [
                    'model' => $this->model,
                    'messages' => $messages,
                    'temperature' => 0.7,
                ]);

            if ($response->successful()) {
                return $response->json()['choices'][0]['message']['content'] ?? 'Nenhuma resposta gerada.';
            }

            Log::error('AI API Error', $response->json());
            return ['error' => 'Falha na comunicação com a IA (' . $response->status() . ').'];
        } catch (\Exception $e) {
            Log::error('AI Connection Error: ' . $e->getMessage());
            return ['error' => 'Erro de conexão.'];
        }
    }
}

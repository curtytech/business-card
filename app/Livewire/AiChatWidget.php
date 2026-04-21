<?php

namespace App\Livewire;

use App\Services\OpenAIService;
use Livewire\Component;

class AiChatWidget extends Component
{
    public bool $isOpen = false;
    public string $message = '';
    public array $messages = [];
    public bool $isLoading = false;

    public function mount()
    {
        $this->messages[] = [
            'role' => 'assistant',
            'content' => 'Olá! Sou o assistente virtual do projeto Business Card. Como posso ajudar você hoje com dúvidas sobre o código ou funcionalidades?'
        ];
    }

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function sendMessage(OpenAIService $aiService)
    {
        if (empty(trim($this->message))) {
            return;
        }

        $userMessage = $this->message;
        $this->message = '';
        $this->messages[] = ['role' => 'user', 'content' => $userMessage];
        $this->isLoading = true;

        // Contexto do projeto para a IA
        $systemPrompt = "Você é um especialista no projeto 'Business Card', desenvolvido em Laravel 12, Filament 3.3 e TailwindCSS.
        
        O projeto consiste em um gerador de cartões de visita digitais.
        
        Estrutura Principal:
        - Models: User (com campos como name, role, slug, avatar, template, etc.), Template.
        - Filament Resources: UserResource (Gerenciamento de usuários, upload de fotos, seleção de templates).
        - Templates Blade: resources/views/users/templates/ (default, elegant, minimal, bold, modern).
        - Funcionalidades:
          - Geração de QR Code (UserQrWidget).
          - Visualização pública do cartão (/users/{slug}).
          - Download de VCard.
          - Captura de tela e vídeo para stories (html2canvas, MediaRecorder).
          - Templates responsivos com Tailwind.
        
        Sua função é tirar dúvidas técnicas e de uso sobre esse projeto. Responda em português de forma concisa e útil.";

        $apiMessages = array_merge(
            [['role' => 'system', 'content' => $systemPrompt]],
            $this->messages
        );

        // Chamada à API
        $response = $aiService->chat($apiMessages);

        if (is_array($response) && isset($response['error'])) {
            $this->messages[] = ['role' => 'assistant', 'content' => 'Desculpe, ocorreu um erro: ' . $response['error']];
        } else {
            $this->messages[] = ['role' => 'assistant', 'content' => $response];
        }

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.ai-chat-widget');
    }
}

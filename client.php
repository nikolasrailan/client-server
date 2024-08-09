<?php
$host = '127.0.0.1';
$port = 8080;

// Cria um socket TCP
$client = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($client === false) {
    die("Não foi possível criar o socket: " . socket_strerror(socket_last_error()) . "\n");
}

// Conecta ao servidor
if (socket_connect($client, $host, $port) === false) {
    die("Não foi possível conectar ao servidor: " . socket_strerror(socket_last_error($client)) . "\n");
}

// Envia uma mensagem ao servidor
$message = "Olá, servidor!";
socket_write($client, $message, strlen($message));

// Lê a resposta do servidor
$response = socket_read($client, 1024);
echo "Resposta do servidor: $response\n";

// Fecha o socket do cliente
socket_close($client);
?>

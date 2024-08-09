<?php
$host = '127.0.0.1';
$port = 8080;

// Cria um socket TCP
$server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($server === false) {
    die("Não foi possível criar o socket: " . socket_strerror(socket_last_error()) . "\n");
}

// Liga o socket ao endereço e porta
if (socket_bind($server, $host, $port) === false) {
    die("Não foi possível ligar o socket: " . socket_strerror(socket_last_error($server)) . "\n");
}

// Escuta por conexões
if (socket_listen($server, 5) === false) {
    die("Não foi possível escutar no socket: " . socket_strerror(socket_last_error($server)) . "\n");
}

echo "Servidor escutando em $host:$port...\n";

while (true) {
    // Aceita uma nova conexão
    $client = socket_accept($server);
    if ($client === false) {
        echo "Não foi possível aceitar a conexão: " . socket_strerror(socket_last_error($server)) . "\n";
        continue;
    }

    // Lê a mensagem do cliente
    $input = socket_read($client, 1024);
    echo "Mensagem recebida: $input\n";

    // Envia uma resposta ao cliente
    $response = "Mensagem recebida";
    socket_write($client, $response, strlen($response));

    // Fecha a conexão com o cliente
    socket_close($client);
}

// Fecha o socket do servidor
socket_close($server);
?>

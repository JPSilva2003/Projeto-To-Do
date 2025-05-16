<?php
$key = openssl_pkey_new([
    'private_key_type' => OPENSSL_KEYTYPE_EC,
    'curve_name' => 'prime256v1',
]);

if (!$key) {
    echo "❌ ERRO ao criar chave:\n";
    while ($msg = openssl_error_string()) {
        echo "  • $msg\n";
    }
} else {
    echo "✅ Chave gerada com sucesso.\n";
}

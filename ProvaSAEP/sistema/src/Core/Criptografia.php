<?php
namespace App\Core;
use RuntimeException;
/**
 * Classe responsável pela criptografia e descriptografia simétrica de dados pessoais sensíveis (LGPD).
 * Utiliza o algoritmo padrão AES-256-CBC com vetor de inicialização (IV) aleatório e chave externa.
 */
class Criptografia
{
    private const CIPHER = 'aes-256-cbc';
    private static ?string $chaveCache = null;
    /**
     * Obtém a chave simétrica de 256 bits (32 bytes).
     * A leitura prioriza a variável de ambiente APP_KEY; caso não exista, busca no database.ini.
     * Nunca deixa a chave gravada de forma fixa no código-fonte.
     *
     * @return string
     */
    public static function obterChave(): string
    {
        if (self::$chaveCache !== null) {
            return self::$chaveCache;
        }
        $chaveRaw = getenv('APP_KEY');
        if (!$chaveRaw) {
            $config = ConexaoBanco::carregarConfig();
            $chaveRaw = $config['security']['app_key'] ?? '';
        }
        if (empty($chaveRaw)) {
            throw new RuntimeException("Chave de criptografia (APP_KEY) não configurada no arquivo database.ini nem no ambiente.");
        }
        // Garante que a chave possua exatamente 32 bytes (256 bits) através de hash binário
        self::$chaveCache = hash('sha256', $chaveRaw, true);

                return self::$chaveCache;
    }
    /**
     * Criptografa uma string usando AES-256-CBC com IV aleatório.
     *
     * @param string $dado Dado em texto plano a ser protegido
     * @return string Dado protegido codificado em Base64 (IV + Ciphertext)
     */
    public static function criptografar(string $dado): string
    {
        if ($dado === '') {
            return '';
        }
        $chave = self::obterChave();
        $iv = random_bytes(openssl_cipher_iv_length(self::CIPHER));
        $ciphertext = openssl_encrypt(
            $dado,
            self::CIPHER,
            $chave,
            OPENSSL_RAW_DATA,
            $iv
        );
        if ($ciphertext === false) {
            throw new RuntimeException("Falha ao criptografar o dado com AES-256-CBC.");
        }

              // Concatena IV (16 bytes) com o texto cifrado e codifica em Base64 para persistência segura
        return base64_encode($iv . $ciphertext);
    }
    /**
     * Descriptografa um valor criptografado previamente.
     *
     * @param string $dadoCriptografado Dado codificado em Base64 (IV + Ciphertext)
     * @return string Texto original descriptografado
     */
    public static function descriptografar(string $dadoCriptografado): string
    {
        if (empty($dadoCriptografado)) {
            return '';
        }
        $chave = self::obterChave();
        $dadosBrutos = base64_decode($dadoCriptografado, true);
        if ($dadosBrutos === false) {
            return '';
        }
        $ivLength = openssl_cipher_iv_length(self::CIPHER);
        if (strlen($dadosBrutos) <= $ivLength) {
            return '';
        }

          $iv = substr($dadosBrutos, 0, $ivLength);
        $ciphertext = substr($dadosBrutos, $ivLength);
        $plaintext = openssl_decrypt(
            $ciphertext,
            self::CIPHER,
            $chave,
            OPENSSL_RAW_DATA,
            $iv
        );
        return $plaintext !== false ? $plaintext : '';
    }
    /**
     * Remove caracteres não numéricos de um CPF.
     *
     * @param string $cpf
     * @return string
     */
    public static function limparCpf(string $cpf): string
    {
        return preg_replace('/\D/', '', $cpf) ?? '';
    }
    /**
     * Formata um CPF numérico para o padrão 000.000.000-00.
     *
     * @param string $cpf
     * @return string
     */
    public static function formatarCpf(string $cpf): string
    {
        $limpo = self::limparCpf($cpf);
        if (strlen($limpo) !== 11) {
            return $cpf;
        }

           return substr($limpo, 0, 3) . '.' .
               substr($limpo, 3, 3) . '.' .
               substr($limpo, 6, 3) . '-' .
               substr($limpo, 9, 2);
    }
    /**
     * Aplica máscara de proteção de dados pessoais (ex: 123.***.***-01).
     *
     * @param string $cpf
     * @return string
     */
    public static function mascararCpf(string $cpf): string
    {
        $limpo = self::limparCpf($cpf);
        if (strlen($limpo) !== 11) {
            return $cpf;
        }
        return substr($limpo, 0, 3) . '.***.***-' . substr($limpo, 9, 2);
    }
}
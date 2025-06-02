<?php
namespace Services;

class UploadHandler {
    private string $uploadDir;
    private array $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    private int $maxFileSize = 5242880; // 5MB

    public function __construct(string $uploadDir = 'img/uploads/') {
        $this->uploadDir = $uploadDir;
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function handleUpload(array $file): ?string {
        if (!isset($file['error']) || is_array($file['error'])) {
            throw new \RuntimeException('Invalid parameters.');
        }

        switch ($file['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new \RuntimeException('No file sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new \RuntimeException('Exceeded filesize limit.');
            default:
                throw new \RuntimeException('Unknown errors.');
        }

        if ($file['size'] > $this->maxFileSize) {
            throw new \RuntimeException('Exceeded filesize limit.');
        }

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);

        if (!in_array($mimeType, $this->allowedTypes)) {
            throw new \RuntimeException('Invalid file format.');
        }

        $extension = array_search($mimeType, [
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ], true);

        $filename = sprintf('%s.%s',
            sha1_file($file['tmp_name']),
            $extension
        );

        if (!move_uploaded_file(
            $file['tmp_name'],
            $this->uploadDir . $filename
        )) {
            throw new \RuntimeException('Failed to move uploaded file.');
        }

        return 'img/uploads/' . $filename;
    }
} 
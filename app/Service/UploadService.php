<?php


namespace App\Service;


use App\Exception\BusinessException;
use App\Util\SystemConfigUtil;

class UploadService
{
    public function uploadFile($file, $uploadPath, $allowExt, $maxSize = 2, &$fileName = null)
    {
        if (!empty($file) && $file->getSize() > 0 && $file->isValid()) {
            if ($file->getSize() > $maxSize * 1024 * 1024) throw new BusinessException("上传文件不能大于{$maxSize}MB");
            $ext = strtolower($file->getExtension());
            $allowExtArr = explode('/', $allowExt);
            if (!in_array($ext, $allowExtArr)) throw new BusinessException("只能上传{$allowExt}文件后缀");
            $fullDirName = BASE_PATH . $uploadPath;
            if (!is_dir($fullDirName)) mkdir($fullDirName, 755, 1);
            $fileName = $fileName == null ? $file->getClientFilename() : $fileName . '.' . $ext;
            $file->moveTo($fullDirName . $fileName);
            if ($file->isMoved()) {
                $filePath = str_replace('/public/', '/', $uploadPath) . $fileName;
                return [
                    'full_url' => SystemConfigUtil::get('api_gateway', 'http://upload.host') . $filePath,
                    'file_path' => $filePath
                ];
            } else throw new BusinessException('上传失败');
        } else throw new BusinessException('上传文件不能为空');
    }
}
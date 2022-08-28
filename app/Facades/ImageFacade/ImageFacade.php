<?php
namespace App\Facades\ImageFacade;

use Illuminate\Support\Facades\Storage;
use Imagick;
use ImagickException;

class ImageFacade
{
    public static string $thumbsDir = 'upload/';
    public const THUMBS_DIR_DEFAULT = 'upload/';
    public const THUMBS_WIDTH_DEFAULT = 800;

    public function __construct() {}

    public static function getThumbsDir(): string {
        return self::$thumbsDir ?? self::THUMBS_DIR_DEFAULT;
    }

    /**
     * @throws ImagickException
     */
    public static function createThumbsFromDir(string $dir, string $format = 'jpg', int $width): void {
        $format = $format ?? 'jpg';
        $images = new Imagick(glob("$dir/*.$format"));
        foreach($images as $image) {
            // Передаём 0 в thumbnailImage для сохранения соотношения сторон
            $image->thumbnailImage(1024,0);
        }
        $images->writeImages();
    }

    public static function createMini(string $imagePath, string $thumbDir, ?int $width = 800): void {
        //header('Content-type: image/jpeg');
        $dir = $thumbDir ?? self::getThumbsDir();
        $width = $width ?? self::THUMBS_WIDTH_DEFAULT;

        if (!file_exists($dir)) {
            Storage::makeDirectory($dir, 0777);
        }

        $image = new Imagick($imagePath);
        $image->readImage($imagePath);
        $image->thumbnailImage($width, 200, true);
        $fileName = '800x200_thumbnailImage_true.jpg';
        $image->writeImage(storage_path("app/" . $dir . $fileName));
        //file_put_contents( public_path("storage/" . $dir) . "/" . $fileName, $image);
    }
}

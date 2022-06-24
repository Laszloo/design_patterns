<?php


/**
 * Converter Library
 */

class ResponseVideoFile {
    public function emit()
    {
       return "Your video is successfully converted!".PHP_EOL;
    }
}
class VideoFile {
}
class Request {
    public function getType() {
        return "video/mp4";
    }
}
class RequestVideoFile extends Request {
}
class RequestValidator {
    public function validate(Request $request) {
        return true;
    }
}
class Resolution {
}
class MP4Converter {
}
class AVIConverter {
}
class MP3Converter {
}


interface ConverterPlugin {
    public function convert($request);
}

class Facade implements ConverterPlugin {
    public function convert($file) {
        $requestVideoFile = new RequestVideoFile($file);
        $convertedFile = null;
        if ((new RequestValidator())->validate($requestVideoFile)) {
            /**
             * other code
             */
            if ($requestVideoFile->getType() == "video/mp4") {
                //setResolution etc...
            }
            return (new ResponseVideoFile($convertedFile))->emit();
        }
        throw new InvalidArgumentException("This file is not correct!");
    }
}


class OurApplication {
    private $plugin;
    public function __construct(ConverterPlugin $converterPlugin) {
        $this->plugin = $converterPlugin;
    }
    public function convert($file)
    {
        echo $this->plugin->convert($file);
    }
}
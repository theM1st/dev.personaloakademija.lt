<?php

if (!function_exists('classActivePath')) {
    function classActivePath($path, $segment=1)
    {
        $path = explode('.', $path);

        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return ' active';
    }
}

if (!function_exists('appLanguages')) {
    function appLanguages()
    {
        return collect([
            (object)[ 'name' => 'Lietuvių', 'locale' => 'lt', 'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAUCAIAAACMMcMmAAAANElEQVRIx2P8u1OYgcaAcdSOkWfHsnkqNLeDIctl1I5RO6huR72dKc3tOKiuO2rHqB3UBgBSBxe3gsmmOAAAAABJRU5ErkJggg==' ],
            (object)[ 'name' => 'Anglų', 'locale' => 'en', 'image' => ' data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAUCAMAAADImI+JAAAAjVBMVEUAJH0OMIQPMYUQMoVYcKpieK9iea99j71+kL1/kb6Akr6erM6frM6frc6grc+suNTAyd/PFCvaTF7bTV/bTl/bUGHbUWLcVGTcVWXgZXTmucPnipbni5bnjJfnusToj5nowMnpwMnw1tzzwsjzw8nzxsv0x8z14eb32Nz32d357vH57/H79fb8+Pn///8pdguvAAAA4ElEQVR42sXTyRKCMBBF0WZQAUENDogTggMo+v7/8yRpSRm0LHfe9VkknQ7FB+AaWtTmQjTBpTZrsJqJxZmWQtHI/gxtTzGAglxTEzLbMauHRI6iR3kA24DM5ifJHCKSdJ+IKVMNX1jEzKSjHsOe32Uu1x8XWbqugDvDcpNuL8Bt0n8CQjeGb5H4sT/Cny+jxzO5AZdtuikZ3oFqnWbFWI9H5UQ1cJqL2c5vBz66AsepSPYBD9xk3usThh3qDDXrLAXTWCxzSSU7L5i9r1nU0IOixGzFzIAmJcUG375CqOgDi8Q+w2/CRkgAAAAASUVORK5CYII=' ]
        ]);
    }
}
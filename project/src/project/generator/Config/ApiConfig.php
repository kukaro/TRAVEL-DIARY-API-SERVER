<?php

namespace Config;

class ApiConfig
{
    public static $data = [
        "Controller" => [
            "path" => "../app/Http/Controllers",
            "name" => "<0>Controller.php",
            "template_path" => "template/api/Controller",
        ],
        "Dto" => [
            "path"=>"../app/Http/Dto",
            "name"=>"<0>Dto.php",
            "template_path" => "template/api/Dto",
        ],
        "RepositoryClasses" => [
            "path"=>"../app/Http/Repositories/Classes",
            "name"=>"<0>Repository.php",
            "template_path" => "template/api/RepositoryClasses",
        ],
        "RepositoryInterfaces" => [
            "path"=>"../app/Http/Repositories/Interfaces",
            "name"=>"<0>RepositoryImpl.php",
            "template_path" => "template/api/RepositoryInterfaces",
        ],
        "RestRequest" => [
            "path"=>"../app/Http/Requests/RestRequests",
            "name"=>"<0>RestRequest.php",
            "template_path" => "template/api/RestRequest",
        ],
        "ServicesClasses" => [
            "path"=>"../app/Http/Services/Classes",
            "name"=>"<0>ServiceImpl.php",
            "template_path" => "template/api/ServicesClasses",
        ],
        "ServicesInterfaces" => [
            "path"=>"../app/Http/Services/Interfaces",
            "name"=>"<0>Service.php",
            "template_path" => "template/api/ServicesInterfaces",
        ],
        "ProvidersPart" => [
            "path"=>"../app/Providers/RestService",
            "name"=>"<0>Part.php",
            "template_path" => "template/api/ProvidersPart",
        ],
    ];
}

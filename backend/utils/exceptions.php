<?php

class HttpException extends Exception
{
    protected $status = 500;

    public function get_status()
    {
        return $this->status;
    }
}

/** 400 – Neispravan unos ili prekršeno poslovno pravilo */
class ValidationException extends HttpException { protected $status = 400; }

/** 401 – Korisnik nije prijavljen */
class UnauthorizedException extends HttpException { protected $status = 401; }

/** 403 – Korisnik nema pravo pristupa */
class ForbiddenException extends HttpException { protected $status = 403; }

/** 404 – Entitet nije pronađen u bazi */
class NotFoundException extends HttpException { protected $status = 404; }

/** 503 – Vanjski API nije dostupan */
class ExternalServiceException extends HttpException { protected $status = 503; }
<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\ContentBannersRestApi\Api\Storefront\Exception;

use Spryker\ApiPlatform\Exception\GlueApiException;
use Spryker\Glue\ContentBannersRestApi\ContentBannersRestApiConfig;
use Symfony\Component\HttpFoundation\Response;

class ContentBannersExceptionFactory
{
    public function createContentBannerNotFoundException(): GlueApiException
    {
        return new GlueApiException(
            Response::HTTP_NOT_FOUND,
            ContentBannersRestApiConfig::RESPONSE_CODE_CONTENT_NOT_FOUND,
            ContentBannersRestApiConfig::RESPONSE_DETAILS_CONTENT_NOT_FOUND,
        );
    }

    public function createContentKeyMissingException(): GlueApiException
    {
        return new GlueApiException(
            Response::HTTP_BAD_REQUEST,
            ContentBannersRestApiConfig::RESPONSE_CODE_CONTENT_KEY_IS_MISSING,
            ContentBannersRestApiConfig::RESPONSE_DETAILS_CONTENT_KEY_IS_MISSING,
        );
    }

    public function createContentTypeInvalidException(): GlueApiException
    {
        return new GlueApiException(
            Response::HTTP_UNPROCESSABLE_ENTITY,
            ContentBannersRestApiConfig::RESPONSE_CODE_CONTENT_TYPE_INVALID,
            ContentBannersRestApiConfig::RESPONSE_DETAILS_CONTENT_TYPE_INVALID,
        );
    }
}

<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types=1);

namespace Spryker\Glue\ContentBannersRestApi\Api\Storefront\Provider;

use Generated\Api\Storefront\ContentBannersStorefrontResource;
use Generated\Shared\Transfer\ContentBannerTypeTransfer;
use Spryker\ApiPlatform\State\Provider\AbstractStorefrontProvider;
use Spryker\Client\ContentBanner\ContentBannerClientInterface;
use Spryker\Client\ContentBanner\Exception\MissingBannerTermException;
use Spryker\Glue\ContentBannersRestApi\Api\Storefront\Exception\ContentBannersExceptionFactory;

class ContentBannersStorefrontProvider extends AbstractStorefrontProvider
{
    protected const string URI_VAR_ID = 'id';

    public function __construct(
        protected ContentBannerClientInterface $contentBannerClient,
        protected ContentBannersExceptionFactory $exceptionFactory,
    ) {
    }

    /**
     * @throws \Spryker\ApiPlatform\Exception\GlueApiException
     */
    protected function provideItem(): ?object
    {
        $contentKey = (string)$this->findUriVariable(static::URI_VAR_ID);

        if ($contentKey === '') {
            throw $this->exceptionFactory->createContentKeyMissingException();
        }

        try {
            $contentBannerTypeTransfer = $this->contentBannerClient->executeBannerTypeByKey(
                $contentKey,
                $this->getLocale()->getLocaleNameOrFail(),
            );
        } catch (MissingBannerTermException) {
            throw $this->exceptionFactory->createContentTypeInvalidException();
        }

        if ($contentBannerTypeTransfer === null) {
            throw $this->exceptionFactory->createContentBannerNotFoundException();
        }

        return $this->buildResource($contentKey, $contentBannerTypeTransfer);
    }

    /**
     * @throws \Spryker\ApiPlatform\Exception\GlueApiException
     *
     * @return never
     */
    protected function provideCollection(): array
    {
        throw $this->exceptionFactory->createContentKeyMissingException();
    }

    protected function buildResource(
        string $contentKey,
        ContentBannerTypeTransfer $contentBannerTypeTransfer,
    ): ContentBannersStorefrontResource {
        $resource = new ContentBannersStorefrontResource();
        $resource->id = $contentKey;
        $resource->title = $contentBannerTypeTransfer->getTitle();
        $resource->subtitle = $contentBannerTypeTransfer->getSubtitle();
        $resource->imageUrl = $contentBannerTypeTransfer->getImageUrl();
        $resource->clickUrl = $contentBannerTypeTransfer->getClickUrl();
        $resource->altText = $contentBannerTypeTransfer->getAltText();

        return $resource;
    }
}

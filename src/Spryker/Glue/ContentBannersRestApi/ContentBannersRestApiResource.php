<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\ContentBannersRestApi;

use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractRestResource;

/**
 * @method \Spryker\Glue\ContentBannersRestApi\ContentBannersRestApiFactory getFactory()
 */
class ContentBannersRestApiResource extends AbstractRestResource implements ContentBannersRestApiResourceInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @phpstan-return array<string, \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface>
     *
     * @param string[] $contentBannerKeys
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[]
     */
    public function getContentBannersByKeys(array $contentBannerKeys, RestRequestInterface $restRequest): array
    {
        return $this->getFactory()
            ->createContentBannerReader()
            ->getContentBannersResources($contentBannerKeys, $restRequest);
    }
}

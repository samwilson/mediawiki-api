<?php

namespace Mediawiki\Api\Service;

use Mediawiki\Api\MediawikiApi;
use Mediawiki\DataModel\Page;
use Mediawiki\DataModel\Revision;

/**
 * @author Adam Shorland
 */
class PageDeleter {

	/**
	 * @var MediawikiApi
	 */
	private $api;

	/**
	 * @param MediawikiApi $api
	 */
	public function __construct( MediawikiApi $api ) {
		$this->api = $api;
	}

	/**
	 * @since 0.2
	 *
	 * @param Page $page
	 * @param null|string $reason
	 *
	 * @return bool
	 */
	public function delete( Page $page, $reason = null ) {
		$this->api->postAction( 'delete', $this->getDeleteParams( $page->getId(), $reason ) );
		return true;
	}

	/**
	 * @since 0.2
	 *
	 * @param Revision $revision
	 * @param null|string $reason
	 *
	 * @return bool
	 */
	public function deleteFromRevision( Revision $revision, $reason = null ) {
		$this->api->postAction( 'delete', $this->getDeleteParams( $revision->getPageId(), $reason ) );
		return true;
	}

	/**
	 * @since 0.2
	 *
	 * @param int $pageid
	 * @param null|string $reason
	 *
	 * @return bool
	 */
	public function deleteFromPageId( $pageid, $reason = null ) {
		$this->api->postAction( 'delete', $this->getDeleteParams( $pageid, $reason ) );
		return true;
	}

	/**
	 * @param int $pageid
	 * @param string|null $reason
	 *
	 * @return array
	 */
	private function getDeleteParams( $pageid, $reason ) {
		$params = array();

		if( !is_null( $reason ) ) {
			$params['reason'] = $reason;
		}
		$params['pageid'] = $pageid;
		$params['token'] = $this->api->getToken( 'delete' );

		return $params;
	}

} 
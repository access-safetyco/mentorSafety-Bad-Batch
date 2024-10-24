<?php
/**
 * WooCommerce Authorize.Net Gateway
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade WooCommerce Authorize.Net Gateway to newer
 * versions in the future. If you wish to customize WooCommerce Authorize.Net Gateway for your
 * needs please refer to http://docs.woocommerce.com/document/authorize-net-cim/
 *
 * @author    SkyVerge
 * @copyright Copyright (c) 2013-2024, SkyVerge, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

defined( 'ABSPATH' ) or exit;

use SkyVerge\WooCommerce\PluginFramework\v5_12_6 as Framework;

/**
 * Authorize.Net API transaction details request class.
 *
 * @since 2.10.0
 */
class WC_Authorize_Net_CIM_API_Transaction_Details_Request extends WC_Authorize_Net_CIM_API_Request  {


	/**
	 * Sets the data for requesting transaction details.
	 *
	 * @since 2.10.0
	 *
	 * @param string $transaction_id Authorize.Net transaction ID
	 * @param int $order_id WoCommerce order ID
	 */
	public function set_transaction_data( $transaction_id, $order_id = null ) {

		$this->request_type = 'getTransactionDetailsRequest';

		$this->request_data = array(
			'refId'   => $order_id,
			'transId' => $transaction_id,
		);
	}


}

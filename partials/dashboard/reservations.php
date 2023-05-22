<?php

use sendReservation\helpers\ReservationsHelper;

$reservations_helper = new ReservationsHelper;
$reservations        = $reservations_helper->get_reservations();
$head                = $reservations_helper->get_header();
$form_submit_url     = plugin_dir_url( SEND_RESERVATION_PLUGIN_FILE_PATH ) . 'app/reservation-form-submit.php';
?>

<style>
    #wpfooter {
        position: relative;
    }

    .col-nr-0,
    .col-nr-1 {
        width: 6%;
    }
</style>

<div class="wrap">
    <div id="icon-users" class="icon32"></div>
        <h2>Reservations</h2>
        <table class="wp-list-table widefat fixed striped table-view-list contact_forms">
            <thead>
                <tr>
                    <?php foreach ( $head as $key => $column ) { ?>
                        <th scope="col" style="font-weight: bold;" class="manage-column column-primary col-nr-<?= $key ?>">
                            <span><?= $column ?></span>
                        </th>
                    <?php } ?>
                    <th style="font-weight: bold;">Action</th>
                </tr>
            </thead>

            <tbody id="the-list" data-wp-lists="list:contact_form">
                <?php foreach ( $reservations as $key => $reservation_records ) { ?>
                    <tr>
                        <?php foreach ( $reservation_records as $key => $reservation ) { ?>
                            <?php if ( $key !== 'mail_sent' ) { ?>
                                <td class="has-row-actions column-primary">
                                    <span><?= $reservation ?></span>
                                </td>
                            <?php } ?>
                        <?php } ?>
                        <td>
                            <?php if ( ! $reservation_records['mail_sent'] ) { ?>
                                <form action="<?= $form_submit_url ?>" method="POST">
                                    <input type="hidden" name="reservation_id" value="<?= $reservation_records['reservation_id'] ?>">
                                    <button class="button action" type="submit" name="submit_button">Send Email</button>
                                </form>
                            <?php } else { ?>
                                Mail sent
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

            <tfoot>
	            <tr>
                    <?php foreach ( $head as $key => $column ) { ?>
                        <th scope="col" style="font-weight: bold;" class="manage-column column-primary">
                            <span><?= $column ?></span>
                        </th>
                    <?php } ?>
                    <th style="font-weight: bold;">Action</th>
                </tr>
	        </tfoot>

        </table>
    </div>
</div>

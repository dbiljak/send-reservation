<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-size: auto;" width="100%">
    <tbody>
        <tr>
            <td>
                <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url('<?= plugin_dir_url( SEND_RESERVATION_PLUGIN_FILE_PATH ) ?>images/email-background.jpg'); background-repeat: no-repeat; color: #000000; background-size: cover; width: 640px;" width="640">
                    <tbody>
                        <tr>
                            <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                <table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tr>
                                        <td class="pad"
                                            style="padding-top:10px;width:100%;padding-right:0px;padding-left:0px;">
                                            <div align="center" class="alignment" style="line-height:10px">
                                                <img alt="I'm an image" src="<?= plugin_dir_url( SEND_RESERVATION_PLUGIN_FILE_PATH ) ?>images/logo-light.png" style="display: block; height: auto; border: 0; width: 128px; max-width: 100%;" title="I'm an image" width="128" />
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table border="0" cellpadding="0" cellspacing="0" class="divider_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tr>
                                        <td class="pad" style="padding-bottom:20px;padding-left:10px;padding-right:10px;padding-top:20px;">
                                            <div align="center" class="alignment">
                                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                    <tr>
                                                        <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;">
                                                            <span></span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <?= get_partial( 'email/components/title', [ 'name' => $name ] ) ?>
                                <table border="0" cellpadding="0" cellspacing="0" class="image_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                    <tr>
                                        <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
                                            <div align="center" class="alignment" style="line-height:10px">
                                                <img alt="Alternate text" class="big" src="<?= plugin_dir_url( SEND_RESERVATION_PLUGIN_FILE_PATH ) ?>images/email-top-line.png" style="display: block; height: auto; border: 0; width: 416px; max-width: 100%;" title="Alternate text" width="416" />
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <?= get_partial( 'email/components/text' ) ?>
                                <?= get_partial( 'email/components/post-text' ) ?>
                                <div class="spacer_block block-9" style="height:65px;line-height:65px;font-size:1px;"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
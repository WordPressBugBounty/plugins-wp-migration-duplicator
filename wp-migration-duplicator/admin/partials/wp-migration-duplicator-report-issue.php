<?php
if (!defined('ABSPATH')) {
	exit;
}
?>

<div class="wt_mgdp_feedback_loader_info_box postbox">
    <div class="wt-feedback-form wt-feedback-form-shadow">
        <div style="width: 100%">
            <input placeholder="<?php esc_html_e('Enter your email address.', 'wp-migration-duplicator'); ?>" type="text" name="wt-feedback-email" class="wt-feedback-email" style="width: 100%;margin-top: 12px;" required/>
        </div>
        <div  style="width: 100%">
            <textarea rows="3" id="wt-feedback-message" class="wt-feedback-message" placeholder="<?php esc_attr_e('Please describe your problem here.', 'wp-migration-duplicator'); ?>" style="width: 100%;margin-top: 12px;" required></textarea>
        </div>
        <div >
            <input type="hidden" name="feedback_attachment_url" id="feedback_attachment_url">
            <input style="text-align:center;margin-top: 5px;" type="button" name="upload-btn" id="feedback_upload-btn" class="feedback-button-primary feedback_upload-btn button-primary" value="<?php esc_html_e('Upload log file', 'wp-migration-duplicator') ?>">
            <span class="wt_mgdp_report_attachment_url"style="margin-top: 10px;word-wrap: break-word;" name="report_attachment_url" ></span>
        </div>
        <div class="wt-field wt-feedback-terms-segment" style="margin-top: 5px;">
            <label for="wt-feedback-terms">
                <input type="checkbox" class="wt-feedback-terms" name="wt-feedback-terms" />
                <?php esc_html_e('I agree.
By submitting this form, I give WebToffee the permission to use my email address to respond to my inquiries. ', 'wp-migration-duplicator'); ?>
                <?php // esc_html_e( "We do not collect any personal data when you submit this form. It's your feedback that we value.", 'wp-migration-duplicator' ); ?>
                <a href="https://www.webtoffee.com/privacy-policy/" target="_blank"><?php esc_html_e( 'Privacy Policy', 'wp-migration-duplicator' ); ?></a>
            </label>
        </div>
        <div class="wt-field">
            <div class="wt-buttons">
                <a class="wt-feedback-cancel" id="wt-feedback-cancel" href="#" style=" margin-top: 12px;"><?php esc_html_e('Cancel', 'wp-migration-duplicator'); ?></a>
                <button type="submit" name="wt-feedback-submit" class="wt-mgdp-send-green-btn">
                    <?php esc_html_e('Send', 'wp-migration-duplicator'); ?>
                </button>
                <div id="btn_loading" class="wf_report_btn_loader"></div>
                <span class="spinner"></span>
                <div class="wt-clear"></div>
            </div>
        </div>
    </div>
</div>
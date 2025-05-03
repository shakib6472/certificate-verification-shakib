<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function cvs_all_certificates_page() {
    global $wpdb;

    // Fetch all certificates from the comments table
    $results = $wpdb->get_results("
        SELECT c.comment_content AS certificate_id, u.display_name AS user_name, p.post_title AS course_name
        FROM {$wpdb->prefix}comments c
        LEFT JOIN {$wpdb->prefix}users u ON c.user_id = u.ID
        LEFT JOIN {$wpdb->prefix}posts p ON c.comment_post_ID = p.ID
        WHERE c.comment_agent = 'TutorLMSPlugin' AND c.comment_type = 'course_completed'
    ");

    ?>
    <div class="wrap">
        <h1>All Certificates</h1>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Certificate ID</th>
                    <th>Course Name</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($results)) : ?>
                    <?php foreach ($results as $row) : ?>
                        <tr>
                            <td><?php echo esc_html($row->user_name); ?></td>
                            <td><?php echo '#' . esc_html($row->certificate_id); ?></td>
                            <td><?php echo esc_html($row->course_name); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3">No certificates found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

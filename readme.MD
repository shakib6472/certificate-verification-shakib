# Certificate Verification Plugin

**Version:** 1.0.0  
**Author:** Shakib Shown  
**Description:** A WordPress plugin to verify Tutor LMS certificates using certificate IDs.

---

## Features
- Verify certificates by entering a certificate ID.
- Displays certificate details (ID, student name, issue date) on successful verification.
- Provides an error message for invalid certificate IDs.
- Includes a shortcode for embedding the verification form.
- Admin page to view all certificates issued.
- Loader animation during certificate verification.

---

## Installation
1. Download the plugin files and place them in the `wp-content/plugins/certificate-verification-shakib` directory.
2. Activate the plugin from the WordPress admin dashboard under **Plugins**.

---

## Usage
1. Add the shortcode `[cvs]` to any page or post where you want the certificate verification form to appear.
2. Enter a certificate ID in the input field and click the **Search** button.
3. The plugin will display the certificate details if the ID is valid or an error message if invalid.

---

## Admin Page
- Navigate to **All Certificates** in the WordPress admin menu to view a list of all issued certificates.
- The table displays the user name, certificate ID, and course name.

---

## Shortcode
- **Shortcode:** `[cvs]`
- **Description:** Embeds the certificate verification form on any page or post.

---

## AJAX Integration
The plugin uses AJAX to handle certificate verification requests without reloading the page. Ensure that the WordPress AJAX URL is accessible for proper functionality.

---

## Loader Animation
- A loader animation is displayed while the certificate verification request is being processed.
- The loader ensures a better user experience by indicating that the system is working.

---

## Developer Notes
- The plugin retrieves certificate data from the WordPress comments table (`wp_comments`) and user data from the users table (`wp_users`).
- Customize the styles in `assets/style.css` and scripts in `assets/script.js` as needed.

---

## License
This plugin is licensed under the [GPL v2 or later](https://www.gnu.org/licenses/gpl-2.0.html).


# Collaborative Glossary

**Contributors:** Pamela Ribeiro
**Tags:** glossary, collaborative, custom post type, glossary plugin  
**Requires at least:** 5.0  
**Tested up to:** 6.2  
**Requires PHP:** 7.2  
**Stable tag:** 1.0  
**License:** GPLv2 or later  
**License URI:** https://www.gnu.org/licenses/gpl-2.0.html  

A collaborative glossary plugin for WordPress.

## Description

Collaborative Glossary Plugin allows users to collaboratively create and manage glossary terms. Each term is a post in a custom post type (CPT). Users can suggest improvements, relate terms, and add relevant links. Administrators can review and approve submissions.

### Features

- Custom Post Type for glossary terms
- Fields for related terms and relevant links
- Users can suggest improvements without logging in
- Administrators can approve or reject suggestions
- Translation support

## Installation

1. Upload the plugin files to the `/wp-content/plugins/collaborative-glossary` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the [ygp_submission_form] shortcode to display the submission form on any page.

## Usage

### Shortcodes

- `[ygp_submission_form]`: Display the form for users to submit new terms.

### Template Functions

You can customize the plugin further by using the provided template functions in your theme.

## Frequently Asked Questions

### How do I approve submitted terms?

Submitted terms will appear as drafts in the "Terms" section of your WordPress admin dashboard. Administrators can review, edit, and publish these drafts.

### Can users submit terms without logging in?

Yes, users can submit terms and suggestions without logging in. All submissions will be reviewed by an administrator before being published.

## Changelog

### 1.0

- Initial release.

## Upgrade Notice

### 1.0

- Initial release.

## Translation

Your Glossary Plugin is ready for translation. The text domain is `collaborative-glossary` and translations can be added to the `/languages/` directory.

## License

This plugin is licensed under the GPLv2 or later. See the [LICENSE](LICENSE) file for more details.

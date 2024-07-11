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

## Features

- **Custom Post Type:** Glossary terms are stored as a custom post type (`glossary_term`).
- **Frontend Submission:** Users can submit new glossary terms via a frontend form without accessing the WordPress dashboard.
- **Term Management:** Admins can review and approve new terms and improvements suggested by users.
- **Related Terms and Links:** Each term can have related terms and relevant links associated with it.
- **Security:** Input sanitization and nonce verification for secure data handling.

## Installation

1. Clone or download the repository into the `wp-content/plugins/` directory of your WordPress installation.
    ```
    git clone https://github.com/your-username/collaborative-glossary.git
    ```

2. Activate the plugin via the WordPress admin panel.

3. Create a new page in WordPress and assign the "Submit Glossary Term" template (`template-submit-term.php`) to allow users to submit new terms.

## Usage

- **Submitting a Term:** Navigate to the "Submit Glossary Term" page on your website. Fill out the form with the term title, definition, related terms (optional), and relevant links (optional). Click "Submit Term" to submit the term for admin approval.
  
- **Admin Approval:** Admins can review submitted terms in the WordPress admin dashboard (`glossary_term` post type). Terms are initially set to "Pending" status and require admin approval before being published.

## Frequently Asked Questions

### How do I update an existing glossary term?
Users can suggest improvements to existing glossary terms by visiting the term's page and using the provided form to submit their suggestions. Admins will review and approve these changes.

### Can users suggest new terms anonymously?
Yes, users do not need to be logged in to suggest new terms or improvements. However, all submissions require admin approval.

## Support

For support or issues, please open an issue [here](https://github.com/your-username/collaborative-glossary/issues).

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
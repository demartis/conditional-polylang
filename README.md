
# Conditional Polylang

**Version:** 1.0.0  
**Author:** Riccardo De Martis  
**LinkedIN URI:** [https://www.linkedin.com/in/rdemartis](https://www.linkedin.com/in/rdemartis)
**Plugin URI:** [https://github.com/demartis/conditional-polylang](https://github.com/demartis/conditional-polylang)

Conditional Polylang is a lightweight WordPress plugin that provides a function and a shortcode to conditionally display content based on the current active language in Polylang.

## Features

- **Language Check Function:** Easily check if the current Polylang language matches a specified language code.
- **Shortcode Support:** Use the `[is_language]` shortcode to display content only when a specific language is active.
- **Internationalization Ready:** Fully prepared for translation.

## Requirements

- WordPress 4.7 or higher.
- [Polylang](https://wordpress.org/plugins/polylang/) plugin must be installed and activated.

## Installation

### Manual Installation via Releases

1. **Download the Plugin:**  
   Download the latest release from the [Releases](https://github.com/rdemartis/conditional-polylang/releases) page.

2. **Extract the Archive:**  
   Unzip the downloaded archive to extract the plugin folder.

3. **Upload the Plugin:**  
   Upload the `conditional-polylang` folder to your `/wp-content/plugins/` directory.

4. **Activate the Plugin:**  
   Go to the **Plugins** menu in your WordPress admin area and activate **Conditional Polylang**.

## Usage

### Using the Shortcode

Use the `[is_language]` shortcode to wrap any content that should only be displayed for a specific language. For example:

```html
[is_language lang="en"]
    This content is displayed only when the current language is English.
[/is_language]
```

### Using the Function

The plugin provides a helper function `conditional_polylang_is_language( $language )` that returns `true` if the current language (from Polylang) matches the specified language code. For example:

```php
if ( conditional_polylang_is_language( 'en' ) ) {
    // Execute code for English language.
}
```


## Changelog

### 1.0.0
- Initial release of Conditional Polylang by Riccardo De Martis.

## License

This plugin is licensed under the GPLv2 (or later) license.

## Support

For support, updates, or further requests, please use [https://github.com/demartis/conditional-polylang/issues](GitHub Issues)



# Conditional Polylang

**Version:** 1.1.0  
**Author:** Riccardo De Martis  
**LinkedIn URI:** [https://www.linkedin.com/in/rdemartis](https://www.linkedin.com/in/rdemartis)  
**Plugin URI:** [https://github.com/demartis/conditional-polylang](https://github.com/demartis/conditional-polylang)  
**License:** LGPL

---

## Quick Usage Examples

### Standalone Shortcode Example

Use the `[if_lang]` shortcode on its own. This will immediately output its content if the current Polylang language matches the provided `lang` attribute:

```html
[if_lang lang="en"]This content is displayed only when the current language is English.[/if_lang]
```

### Container Shortcodes with Fallback

Wrap multiple `[if_lang]` conditions and an `[else_lang]` fallback inside a `[conditional_language]` container. The container will output the first matching `[if_lang]` content; if none match, the `[else_lang]` content will be displayed:

```html
[conditional_language]
  [if_lang lang="gb"]This is the content for GB.[/if_lang]
  [if_lang lang="au"]This is the content for Australia.[/if_lang]
  [else_lang]This is the content for other languages.[/else_lang]
[/conditional_language]
```

### Multiple Language Conditions Example

You can define several conditions within a container for multiple languages, with a fallback if none match:

```html
[conditional_language]
  [if_lang lang="en"]Content for English users.[/if_lang]
  [if_lang lang="es"]Contenido para usuarios en español.[/if_lang]
  [if_lang lang="fr"]Contenu pour les utilisateurs français.[/if_lang]
  [else_lang]Default content for users of other languages.[/else_lang]
[/conditional_language]
```

---

## Features

- **Language Check Function:**  
  Easily check if the current Polylang language matches a specified language code.

- **Shortcode Support:**  
  Two types of shortcode usage:
  - **Standalone `[if_lang]`** – outputs content immediately if the condition is met.
  - **Container-based `[conditional_language]`** – allows grouping multiple `[if_lang]` conditions along with an `[else_lang]` fallback.

- **Internationalization Ready:**  
  Fully prepared for translation.

---

## Requirements

- WordPress 4.7 or higher.
- [Polylang](https://wordpress.org/plugins/polylang/) plugin must be installed and activated.

---

## Installation

### Manual Installation via Releases

1. **Download the Plugin:**  
   Download the latest release from the [Releases](https://github.com/demartis/conditional-polylang/releases) page.

2. **Extract the Archive:**  
   Unzip the downloaded archive to extract the plugin folder.

3. **Upload the Plugin:**  
   Upload the `conditional-polylang` folder to your `/wp-content/plugins/` directory.

4. **Activate the Plugin:**  
   Go to the **Plugins** menu in your WordPress admin area and activate **Conditional Polylang**.

---

## Usage

### Using the Shortcodes

#### Standalone `[if_lang]` Shortcode

This shortcode works outside the container. It immediately outputs its content if the current language matches the specified language code.

Example:

```html
[if_lang lang="en"]This content is displayed only when the current language is English.[/if_lang]
```

#### Container Shortcodes: `[conditional_language]`, `[if_lang]`, and `[else_lang]`

Wrap your language-specific content within the `[conditional_language]` container to provide multiple conditions along with a fallback.

Example:

```html
[conditional_language]
  [if_lang lang="gb"]This is the content for GB.[/if_lang]
  [if_lang lang="au"]This is the content for Australia.[/if_lang]
  [else_lang]This is the content for other languages.[/else_lang]
[/conditional_language]
```

You can also create multiple conditions in one container:

```html
[conditional_language]
  [if_lang lang="en"]Content for English users.[/if_lang]
  [if_lang lang="es"]Contenido para usuarios en español.[/if_lang]
  [if_lang lang="de"]Inhalt für deutsche Benutzer.[/if_lang]
  [else_lang]Fallback: Content for users of other languages.[/else_lang]
[/conditional_language]
```

### Using the Function

The plugin provides a helper function `conditional_polylang_is_language( $language )` that returns `true` if the current Polylang language matches the specified language code. For example:

```php
if ( conditional_polylang_is_language( 'en' ) ) {
    // Execute code for English language.
}
```

---

## Changelog

### 1.1.0
- Added new shortcode syntax: `[conditional_language]`, `[if_lang]`, and `[else_lang]`.
- Improved support for standalone `[if_lang]` usage outside of the container.
- Updated documentation with multiple usage examples.

### 1.0.0
- Initial release of Conditional Polylang by Riccardo De Martis.

---

## License

This plugin is licensed under the LGPL license.

---

## Support

For support, updates, or further requests, please use the [GitHub Issues](https://github.com/demartis/conditional-polylang/issues) page.
```

---

This updated `README.md` provides clear and accessible usage examples at the top, prioritizing the shortcode examples over the function examples. It also details the new capabilities of version 1.1.0 and reflects the new license (LGPL). Enjoy using **Conditional Polylang**!
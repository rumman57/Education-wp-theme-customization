=== Ad Inserter ===
Contributors: spacetime
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LHGZEMRTR7WB4
Tags: adsense, amazon, clickbank, cj, ad, ads, html, javascript, php, code, widget, sidebar, responsive, viewport, rotating, banner, banner rotation, multisite, contextual, shortcodes, widgets, header, footer, users, logged in, not logged in, mobile, desktop, phone, tablet, custom css, category, tag, filter, url, skip
Requires at least: 4.0
Tested up to: 4.6.1
Stable tag: 2.0.2
License: GPLv3

Insert any ad or HTML/Javascript/PHP code into Wordpress. Perfect for all kinds of ads. 16 code blocks, many display options and features.

== Description ==

A simple yet powerful plugin to insert any ad or code into Wordpress. **Perfect for all kinds of ads.** Simply enter any ad or HTML/Javascript/PHP code and select where and how you want to display it.

Ad Inserter supports up to 16 code blocks. Code block is any code (for example AdSense ad) that has to be inserted (displayed) at some position.
Each code block can be configured to insert code at almost any position supported by Wordpress.

**Features**

*   16 code blocks
*   Syntax highlighting editor
*   Code preview with visual CSS editor
*   Automatic positions: before/after post, content, paragraph or excerpt
*   Manual positions: widgets, shortcodes, PHP function call
*   Block alignment and style: left, center, right, float left, float right, custom CSS, no wrapping (leaves ad code as it is, otherwise it is wrapped by a div)
*   Clearance options to avoid insertion near images or headers
*   PHP code processing
*   Server-side and client-side device detection (3 custom viewports)
*   Black/White-list categories, tags, post IDs, urls, url parameters, referers
*   Simple troubleshooting with many debugging functions to visualize inserted code blocks, available insertion positions, HTML tags, etc.

And there is also <a href="http://tinymonitor.com/ad-inserter-pro" target="_blank">Ad Inserter Pro</a> if you need more than 16 code blocks, more than 3 viewports, export/import settings or additional multisite options.

**Quick Start**

Few very important things you need to know in order to insert code and display some ad:

*   **Enable and use at least one display option** (Automatic Display, Widget, Shortcode, PHP function call)
*   **Enable display on at least one Wordpress page type** (Posts, Static pages, Homepage, Category pages, Search Pages, Archive pages)
*   For Posts and static pages **select default value On all Posts / On all Static pages** unless you really know what are you doing
*   If you don't see inserted code block turn on **debuging functions**: Label inserted blocks, Show available positions for automatic display (Ad Inserter menu item in the Wordpress toolbar on the top of every post/page)

Few typical settings are described on the <a href="https://wordpress.org/plugins/ad-inserter/faq/">FAQ</a> page. Please make sure you have also read **WARNINGS** on the bottom of this page and instructions for **Debugging**.

**Settings**

Each code block has 4 display options:

*   Automatic Display
*   Widget
*   Shortcode
*   PHP function call

Normally for each code block you use only one display option.
Of course, you can use all 4 options simultaneously taking into account that all display options use the same block settings (with some exceptions mentioned below).

To rename code block click on the block name. To display code block (ad) at some position **you need to enable and use at least one display option**.

Automatic Display Options:

*   Display Before Post (before post or posts on blog pages, previously named Before Title)
*   Display Before Content (before post or static page text)
*   Display Before Paragraph (on posts, static pages and blog pages)
*   Display After Paragraph (on posts, static pages and blog pages)
*   Display After Content (after post or static page text)
*   Display After Post (after post or posts on blog pages)
*   Display Before Excerpt (on blog pages)
*   Display After Excerpt (on blog pages)

For single posts or static pages display position Before Post usually means position above the post/page title, for blog pages Before Post position means position above all the posts on the blog page.

For single posts or static pages display position After Post means position below the post/page after all the content, for blog pages After Post position means position below all the posts on the blog page.

Order of display positions in a typical post is the following:

*   [Before Post]
*   Post Title
*   [Before Content]
*   Paragraph 1
*   Paragraph 2
*   Paragraph ...
*   Paragraph n - 1
*   Paragraph n
*   [After Content]
*   Comments
*   Output of some other plugins
*   [After Post]

Of course, the final order of items depends also on other plugins. Ad Inserter is by default called as one of the last plugins. You can change Plugin priority on the settings page (tab *).

Please use **Show positions** function to see available positions for automatic display (Ad Inserter menu item in the Wordpress toolbar on the top of every post/page).

Block Alignment and Style:

*   No Wrapping (leaves ad code as it is, otherwise it is wrapped by a div)
*   Custom CSS (You can enter custom CSS code for wrapping div)
*   None (simple div with thin margin)
*   Align Left
*   Align Right
*   Center
*   Float Left (ad on left with wrapped text on right)
*   Float Right (ad on right with wrapped text on left)

**[ Preview ]**

Ad Inserter has a very useful function that can help you to check if the ad code is working and to see how it will look like when it will be inserted. Click on the **Preview** button to open Preview window.
WARNING: Some adblockers may block code on the Ad Inserter preview window. If you see warning PAGE BLOCKED or you don't see your code and the widow elements are distorted, make sure you have disabled ad blockers.
On the top of the window there is visual CSS editor and four buttons and below there is CSS code of the wrapping div (which can be edited manually) and 'Block Alignment and Style' selection.

Below the settings there is a **preview of the saved code** between two dummy paragraphs. Here you can test various block alignments, visually edit margin and padding values of the wrapping div or write CSS code directly
and watch live preview. Highlight button highlights background, wrapping div margin and code area, while Reset button restores all the values to those of the current block.
You can resize the window (and refresh the page to reload ads) to check display with different screen widths. Once you are satisfied with alignment click on the Use button and the settings will be copied to the active block.

**Please note** that the code displayed here is the code that is saved for this block, while block name, alignment and style are taken from the current block settings (may not be saved).
No Wrapping style inserts the code as it is so margin and padding can't be set. However, you can use own HTML code for the block.

**Please note** that Preview window uses also Header and Footer code.

Check <a href="https://wordpress.org/plugins/ad-inserter/screenshots/">screenshots</a> for explanation on alignment.

**PLEASE NOTE:** If you are using **No Wrapping** style and need to hide code on some devices using client-side detection (CSS Media Queries) then you need to add appropriate class to your CSS code (ai-viewport-1, ai-viewport-2, ai-viewport-3).
This doesn't apply to widgets as they always contain a wrapping div.

For all display positions you can also define Wordpress page types where the ads can be displayed. **PLEASE NOTE:** Regardles of other settings you need to enable display on AT LEAST ONE PAGE TYPE:

Single pages:

*   Posts
*   Static pages

Blog pages:

*   Homepage
*   Category pages
*   Search Pages
*   Tag / Archive pages

Insertion (located in the Misc section) is possible also for:

*   404 page (Error 404: Page not found)
*   Feed

**Please Note** For shortcodes and PHP function calls it is possible to ignore enabled page types and use them on any page. See down for details.

You can also disable ads on certain posts or static pages. For each code block on posts or static pages you first define default display settings for posts/pages page type. Then you can define post/page exceptions on the post/page editor page (check Ad Inserter Exceptions meta box below). Exceptions work only on page/post content (positions Before Content, Before Paragraph, After Paragraph, After Content). For one or few exceptions it is easier to first enable ads on All Posts/Static pages page types and then either white or black-list single url or few space-separated urls (click on the Lists button).

**PARAGRAPHS**

Paragraph number for Automatic Display options Before and After Paragraph:

*   0 means random paragraph position
*   value between 0 and 1 means relative position in post or page (e.g. 0.3 means paragraph 30% from top or bottom)
*   1 or more means paragraph number

**[ Counting ]**

Paragraphs can be counted from top or from bottom. It is also possible to count only paragraphs that contain/do not contain certain text or count only paragraphs that have some minimum or maximum number of words.
If more than one text is defined (comma separated) and "contain" is selected then the paragraph must contain ALL texts.

Paragraphs are not counted inside `<blockquote>` elements. Of course, there is an option to enable counting also inside `<blockquote>`.

**Please Note** Paragraph processing works on **every** post or page according to settings. Therefore, if you enable display also on blog pages (home, category, archive, search pages) and your theme does not display post excerpts but complete posts,
Ad Inserter will by default insert code blocks into ALL posts on the blog page (according to settings). To enable insertion only into specific post(s) on blog pages define Filter. You can also leave Filter (click Misc button) empty (means all posts on the blog page) and define maximum number of insertions.

You can also define paragraph HTML tags. Normally only `<p>` tags are used. If your post contains also `<div>` or header tags, you can define comma separated list of tags used to count paragraphs (e.g. **p, div, h2, h3**).

**WARNING:** Each code block you insert in post adds one `<div>` block unelss you use **No wrapping** style. **Before Paragraph** will insert code before `<tag>`, **After Paragraph** will insert code after closing `</tag>`.
**After Paragraph** will not work if you specify tag names that have no closing tags! Use # as tag if paragraphs have no tags and are separated with the `\r\n\r\n` characters.

Minimum number of paragraphs / Minimum/Maximum page/post words: do not display ad if the number of paragraphs or the number of words is below or above limit (used only for position Before or After selected paragraph).

**[ Clearance ]**

You can define parameters to avoid insertion at paragraph positions where above or below is some unwanted element (heading, image, title). This is useful to avoid inserting ads where they may not look good or where it is not allowed.

You can define in how many paragraphs above and below should specified text be avoided. And if the text is found you can choose to either skip insertion or try to shift insertion position up or down up to the specified number of paragraphs.

On every post/page there is a toolbar on the top. Ad Inserter menu item has few functions to visualize tags and positions for automatic insertion:

*   Show HTML tags: visualizes HTML tags
*   Show positions: shows available positions for automatic insertion. It uses paragraph tags for blocks configured for After or Before paragraph.

**Additional Post/Static Page Options**

You can define post/page minimum and maximum word length. Display after N days checks the date when the post was published and delays publishing.

Additional Options for code blocks:

PHP processing: Enabled or Disabled - Enable processing of PHP code. If there is a non-fatal error in the PHP code, it will not break the website.

*   Use {category}, {short_category}, {title}, {short_title}, {tag}, {smart_tag} or {search_query} tags to insert actual post data into code blocks
*   Use {author} for post author username or {author_name} for post author name to insert post author data into code blocks (**works only inside posts**)
*   To rotate different ad versions separate them with `|rotate|` - Ad Inserter will randomly select one of the ads

WARNING: If you are using caching ad rotation may not work as expected. It works only when the page is generated and Ad Inserter is called. In such cases please make sure you have disabled caching when you are using |rotate|.

Ad Inserter is perfect for displaying any kind of ads. It can also be used to display various versions of ad, for example <a href="https://support.google.com/adsense/answer/65083?ctx=as2&rd=2&ref_topic=23389" target="_blank">AdSense ads using channels</a> to test which format or color combination performs best.

**BUTTONS**

**[ Misc ]**

For each code block you can also limit how many times on the page the code (or ad) will be inserted. There are two settings for this:

*   **Max N insertions**: simple limit for the first N calls for the block
*   **Filter**: define which cals are wanted - single number or comma separated numbers

This is **useful in many cases where you can't remove unwanted insertions** of the code with other settings:

*   If you need to insert ad before the first, third and fith excerpt on the homepage you simply specify `1, 3, 5` for the filter.
*   In some WP themes hooks (that call Ad Inserter insertion functions) are called more than once. In such case you might get unwanted insertions. Simply set the filter to the number of the wanted call(s). Use debugging function **Show positions** on every post/page to show available positions for automatic insertion with counters.
*   If you use adinserter PHP function and you don't want that for each time the functon is called on the page the code is inserted, you can simply filter calls.
*   If you oly need the first N calls (insertions) then leave filter to 0 and use Max N insertions instead.

**Please Note** Paragraph processing works on **every** post or page according to settings. Therefore, if you enable display also on blog pages (home, category, archive, search pages) and your theme does not display post excerpts but complete posts,
Ad Inserter will by default insert code blocks into ALL posts on the blog page (according to settings). To enable insertion only into specific post(s) on blog pages define Filter. You can also leave Filter to 0 (means all posts on the blog page) and define maximum number of insertions.

General tag: text used for {tag} and {smart_tag} if the post has no tags - useful for contextual ads - **works only inside posts/static pages!**

Display Block to:

*   All users (default)
*   Logged in users
*   Not logged in users
*   Administrators (usefull for testing/debugging)

**WARNING:** If you are using caching this may not work as expected. The check works only when the page is generated and Ad Inserter is called. Make sure you have disabled caching when you are using such settings.

**[ Lists ]**

Do not display ads in certain caregories e.g sport, news, science,... (black list) or display ads only in certain categories (white list):
leave category list empty and set it to Black list to show ads in all categories.

**WARNING:** If category name contains commas or spaces, use category slug instead. Also make sure you have enabled display on **Category pages**.

Do not display ads in posts with certain tags (black list) or display ads only in posts with certain tags (white list). Leave tag list empty and set it to Black list to show ads for all tags. Also make sure you have enabled display on **Tag / Archive pages**.

Do not display ads in posts/pages with certain post IDs (black list) or display ads only in posts with certain IDs (white list). Leave Post ID list empty and set it to Black list to show ads for all IDs.

Do not display ads on pages with certain urls (black list) or display ads only on pages with certain urls (white list): leave url list empty and set it to Black list to show ads for all urls.
Url used here is everything starting form the `/` after the domain name. For example: if web address is `http://domain.com/lorem-ipsum`, url to white/black-list is `/lorem-ipsum`
You can also use partial urls with *. To filter all urls starting with /url-start use `/url-start*`, to filter all urls that contain url-pattern use `*url-pattern*`, to filter all urls ending with url-end use `*url-end`.
**WARNING:** Separate urls with SPACES.

Do not display ads on pages with certain url query parameters (black list) or display ads only on pages with certain url parameters (white list): leave url parameter list empty and set it to Black list to show ads for all url.
You can specifiy either parameters or parameters with values. For example for url `http://example.com?data=2&customer-id=22&device=0` you can define url parameters '`data, customer-id=22`' to display ad only for urls where there is `data` paramteter and `customer-id` parameter with value 22.
Separate parameters with comma.

Do not display ads to users from certain referers (domains) e.g technorati.com, facebook.com,... (black list) or display ads only for certain referrers (white list): use # for no referer (direct visit),
leave referrers list empty and set it to Black list to show ads for all referrers.

**WARNING:** If you are using caching, referer check may not work as expected. It works only when the page is generated and Ad Inserter is called. Make sure you have disabled caching when you are using such settings.

**[ Devices ]**

**IMPORTANT:** There are two types of device detection: **server side** and **client-side**.

**Client-side** detection

*   Desktop devices
*   Tablet devices
*   Phone devices

**Client-side** detection of mobile/desktop devices works always as it is done in visitor's browser. CSS media queries and viewport (browser's screen) width are used to show or hide Ad Inserter code blocks:

**PLEASE NOTE:** In most cases you should use **ONLY client-side** detection type. Works perfectly with responsive designs as they use CSS media queries.

**BUT BE CAREFUL:** Some ad networks (like AdSense) limit ads per page. The ads are still inserted (loaded and counted) for all devices, but for unwanted devices they are hidden by the browser using CSS media queries based on viewport widths.

Up to 3 viewport names and widths can be defined on the Ad Inserter Settings tab * (<a href="http://tinymonitor.com/ad-inserter-pro" target="_blank">Ad Inserter Pro</a> supports up to 6 viewports). Default values are:

*   Desktop: 980 pixels or more
*   Tablet: from 768 pixels to 979 pixels
*   Phone: less than 768 pixels


**Server-side** detection

*   Desktop devices
*   Mobile devices (tablets and phones)
*   Tablet devices
*   Phone devices
*   Desktop and tablet devices
*   Desktop and phone devices

**Server-side** detection of mobile/desktop devices works only when Ad Inserter plugin is called. It is called by Wordpress when it needs to generate a page. However, when you are using caching, it saves created page for quicker serving.
In such cases **the user might get (saved) page for wrong device** (used by some previous visitor who triggered page caching). To solve this issue use themes that generate separate pages for desktop and mobile devices or use Mobile Theme Switcher plugin.
Server-side detection uses User-Agent string combined with specific HTTP headers to detect the environment.

**PLEASE NOTE:** Use server-side device type detection only when you need to generate (display and count) ONLY code blocks for specific device type. In all other cases switch it off.

**[ Manual ]**

There are 3 independent types of manual insertion of code block:

*   Widget - Widgets for all code blocks are enabled by default - simply drag **Ad Inserter** widget to any widget postition (e.g. Sidebar), select code block, save and you're done.
*   Shortcode - Insert shortcode `[adinserter block="BLOCK_NUMBER"]` or `[adinserter name="BLOCK_NAME"]` into post or page HTML code to display block with BLOCK_NAME name or BLOCK_NUMBER number at this position. **PLEASE NOTE:** Shortcodes IGNORE post/static page exception settings! You can also insert shortcode that ignores enabled page types with `[adinserter block="BLOCK_NUMBER" ignore="page_type"]`
*   PHP function call `<?php if (function_exists ('adinserter')) echo adinserter (BLOCK_NUMBER); ?>` - Insert code block BLOCK_NUMBER at any position in template file. You can also define Filter for PHP function - define which call(s) to the function will actually insert code. This is useful if you put a call to the `adinserter` function inside a loop in a template file (e.g. for homepage) and you need to insert ads only few times between posts. You can also use PHP function calls that ignore enabled page types `<?php if (function_exists ('adinserter')) echo adinserter (BLOCK_NUMBER, 'page_type'); ?>`

**OTHER NOTES**

By default code blocks will not be inserted on Error 404 page (Page Not Found) and in feeds. Check '404 Page' or 'Feed' checkbox to enable code block on error 404 page or in feed.

**Ad Inserter general Settings - last tab**

Wrapping divs for code blocks have 'code-block' and 'code-block-N' classes which can be used for custom styles. Class name 'code-block' can be changed in Ad Inserter settings. If you are using client-side device detection (CSS media queries) then the wrapping div for the code block will have also some of the following classes: ai-viewport-1, ai-viewport-2, ai-viewport-3.

You can choose between many syntax highlighting themes.

By default Ad Inserter exceptions on posts/static pages are enabled only for administrators. You can define minimum user role for page/post Ad Inserter exceptions editing in Ad Inserter Settings (tab *).

Default Ad Inserter plugin processing order is 99999. It is used to specify the order in which the plugin functions are executed. Lower numbers correspond with earlier execution. You can change this value if you have problems with the processing order of other plugins.

Support for Special Code Blocks:

*   Header scripts (scripts in the `<header>` section)
*   Footer scripts (scripts before the `</body>` tag)

**WARNING:** Text selection, Copy and Paste functions with the syntax highlighting editor do not work on mobile devices. If you need these functions you can temporarily swich to **Simple editor** using the checkbox above the code box.

**WARNING:** Some adblockers may block Ad Inserter settings page. If you don't see normal tabs for code blocks or there is no save button, make sure you have whitelisted Ad Inserter settings page (select "Disable on this page" or "Don't run on this page").
However, since you are dealing with ads, it may make sense to temporarily disable adblockers in order to check and debug inserted ad codes.
Some security plugins like WP Security or Wordfence may also detect Ad Inserter page as problematic and prevent it from loading. Please be assured that this is false positive.

**CACHING**

Caching on the frontend side (what visitors see) does speed up page loading but may cause some unwanted behavior.
When you are using caching, Wordpress creates page, Ad Inseter is called to do the job and the created page is saved for quicker serving.
The next time the page is visited **the visitor gets cached (saved) page **. Because of this some Ad Inserter functions can not work because Ad Inserter is not called when the page is cached:

*   Block rotation with `|rotate|`
*   User check
*   Server-side device detection
*   Referer check
*   Debugging functions

When you need the functions listed above you have to switch off caching.

Caching on the backend side (Ad Inserter Settings page) may also cause some unwanted behavior if it is not done properly.
The problem can occur when the plugin is updated since the new plugin also provides new javascript and CSS files.
In order to prevent browsers from loading old js/css files the plugin appends version info as query parameter to js and css files needed.

For example, in the source code of the settings page it should be like this:

`<script type='text/javascript' src='http://example.com/wp-content/plugins/ad-inserter/js/ad-inserter.js?ver=2.0.1'></script>

<link rel='stylesheet' id='ai-admin-css'  href='http://example.com/wp-content/plugins/ad-inserter/css/ad-inserter.css?ver=2.0.1' type='text/css' media='all' />`

However, on some websites this version parameter is removed (very likely due to aggresive caching):

`<script type='text/javascript' src='http://example.com/wp-content/plugins/ad-inserter/js/ad-inserter.js'></script>

<link rel='stylesheet' id='ai-admin-css'  href='http://example.com/wp-content/plugins/ad-inserter/css/ad-inserter.css' type='text/css' media='all' />`

Because of this the old cached files (css and js) are loaded which cause warnings and unpredicted behavior.

If you are using caching make sure the caching software **DOES NOT REMOVE VERSION INFO** parameter from the url. This is needed for browsers to reload the file when the plugin is updated.

**WARNING:** If you are using caching the inserted code may not appear immediately on the page. Make sure you have disabled caching when you are testing or debugging.
Some caching plugins like <a href="https://wordpress.org/plugins/wp-super-cache/" target="_blank">WP Super Cache</a> have an option to disable caching for known users.

**PLEASE DO NOT FORGET:** If you are using caching some settings may not work as expected. For example, ad rotation, referer check, user check and server-side detection work only when the page is generated and Ad Inserter is called.
In such cases please make sure you have disabled caching.

**DEBUGGING**

Ad Inserter has many debugging functions that can help you to diagnose the problem when you don't see your ads at expected positions.

*   Code preview: click on the Preview button for each code block to see how the ad or code will look like. On the Preview window click on the Highlight button to highlight code. If you don't see display of the code here it is very likely that the code is not working properly.
*   Debugger Widget: Place Debugger widget in some widget area to see basic Wordpress page and Ad Inserter data (User status, Page Type, Post ID, Url, Referer, etc). With this widget you can also check saved block settings and client-side viewport name.
*   Debugger Shortcode: Place shortcode [adinserter block="0"] or [adinserter name="Debugger"] into post or static page to see basic Wordpress page and Ad Inserter data

Each post/page has a Wordpress toolbar on the top. Ad Inserter menu (visible only to administrators and can be hidden) item has the following debugging functions:

*   Label Blocks: Each inserted block is labeled with a thin red border and red bar with block number, name and counters. Blocks that use client-side detection and are hidden are shown with blue bar and viewport name - resize the broswer to check display for other devices (or screen widths). If you see only red bar then this means that the block with your **code is inserted** but the code doesn't display anything.
*   Show Positions: Enable this function to show available positions for automatic display. Displayed positions are based on the theme layout and configured paragraph counting. You can choose between all paragraph tag lists (or counting parameters) used for blocks configured for Before or After paragraph. If you click on the Show Positions menu item you'll see default paragraph positions for p tags.
*   Show HTML tags: Enable this function to see HTML tags used in the post. Use this function to determine post structure in order to configure paragraph counting.
*   Disable insertion: Use this function to temporarily disable insertion of code blocks - everything else on the page will look like the code blocks were processed and inserted.
*   Log Processing: Use this function to log insertion process in order to determine why some code block was not inserted. The log is added as HTML comment at the end of the page - check page source

**WARNING:** Make sure **caching is disabled while debugging**! All debugging functions you enable will be visible only to you! Post/page debugging works by adding url parameters to the url (web address):

*   Label Blocks: `ai-debug-blocks=1` (use `ai-debug-blocks=0` to turn it off)
*   Show Positions: `ai-debug-positions=BLOCK_NUMBER`, 0 means default counting of paragraphs with p tags, numbers between 1 and 16 use paragraph counting as configured for the block (use `ai-debug-positions=` to turn it off)
*   Show HTML tags: `ai-debug-tags=1` (use `ai-debug-tags=0` to turn it off)
*   Disable insertion: `ai-debug-no-insertion=1` (use `ai-debug-no-insertion=0` to turn it off)
*   Log Processing: `ai-debug-processing=1` (use `ai-debug-processing=0` to turn it off)

When browsing other pages on the website debuggins settings are temporarily saved (for the session). To disable all debugging functions click on the 'Ad Inserter' top menu item in the toolbar (or use `ai-debug=0`)

If you enable **Remote debugging** you can also allow other people using url parameters to see post/page with debugging data. Remote debugging option is located on the Ad Inserter Settings tab - Debugging tab below.
**Remote debugging** enables other, non-logged in users by using url parameters to see Debugger widget and code insertion debugging (blocks, positions, tags, processing).
Enable this option to allow other people to see Debugger widget, labeled blocks and positions in order to help you to diagnose problems. For logged in users debugging via url is always enabled.

**MULTISITE**

Ad Inserter supports multisite Wordpress installations. Normally, the plugin is available with settings and widgets to all the sites on the network.
<a href="http://tinymonitor.com/ad-inserter-pro" target="_blank">Ad Inserter Pro</a> supports options to disable Setings page, widgets and post/page exceptions for sites (except the main one).

**SUPPORT**

If you experience problems with the Ad Inserter plugin you can ask for help on the <a href ="https://wordpress.org/support/plugin/ad-inserter">support forum</a>.
However, before you ask please use debugging functions described above. In almost all cases it is possible to determine the nature of the problem just by checking the debugging data.
Check also source code of the page. Some code for ads may not display anything, either because of errors in the ad code or because of ad network issues.
In order to be able to diagnose the problem and suggest actions or fix a bug, please do the following:

1. Enable Remote debugging (located on the Ad Inserter Settings tab - Debugging).

2. Clearly describe the problem. Describe what does not work as expected.

3. Describe the settings and code blocks used.

4. Provide web addresses (links) of the pages where the code from the settings above is not inserted properly.

Unless you provide the items listed above nobody can check your website, can't reproduce the problem and consequently can't help. Once the problem is fixed you can disable Remote debugging.
Thank you very much for understanding.

Please **support the plugin** if you like it:

*   Write a nice <a href="https://wordpress.org/support/plugin/ad-inserter/reviews/">review</a>
*   <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LHGZEMRTR7WB4">Donate</a>


== Installation ==

**Automatic installation**: Go to Wordpress Plugins menu, click Add New button, search for "Ad Inserter" and click Install Now.

**Manual installation**:

1. Download the plugin,
2. Go to Wordpress Plugins, Add New, Upload Plugin
3. Choose file, click on Install Now, activate it
3. Go to Settings / Ad Inserter to configure it

**WARNING:** Some adblockers may block Ad Inserter settings page. If you don't see normal tabs for code blocks or there is no save button,
make sure you have whitelisted Ad Inserter settings page (select "Disable on this page" or "Don't run on this page").
However, since you are dealing with ads, it may make sense to temporarily disable adblockers in order to check and debug inserted ad codes.
Some security plugins like WP Security or Wordfence may also detect Ad Inserter page as problematic and prevent it from loading. Please be assured that this is false positive.

**WARNING:** If you are using caching the inserted code may not appear imemdiately on the page. Make sure you have disabled caching when you are testing or debugging.
Some caching plugins like <a href="https://wordpress.org/plugins/wp-super-cache/" target="_blank">WP Super Cache</a> have an option to disable caching for known users.

**WARNING:** If you are using caching some settings may not work as expected. For example, ad rotation, referer check, user check and server-side detection work only when the page is generated and Ad Inserter is called.
In such cases please make sure you have disabled caching when you are using such settings.

**WARNING:** Some code for ads may not display anything, either because of erros in the ad code or because of ad network issues.
Before you report problem please check source code of the page and make sure the code is not inserted where it should be.
The code may be inserted properly but you won't see anything. Try to add some text after the ad code to check if it appears at the expected ad position.

**Ad Inserter Pro Installation**

<a href="http://tinymonitor.com/ad-inserter-pro" target="_blank">Ad Inserter Pro</a> is an upgraded version of the freely available Ad Inserter.
In addition to all the features in the free version it offers 64 code blocks, 6 custom viewports, export and import of settings, additional multisite options and support via email.

If you are using free Ad Inserter simply uninstall it. The Pro version will automatically import existing settings from the free version.
After you receive the email with download link for the Ad Inserter Pro plugin, download it, go to Wordpress Plugins, Add New, Upload Plugin, Choose file, click on Install Now,
activate it and then click "Enter License Key" and enter license key you got in the email. If you need to edit license key go to Ad Inserter settings (tab *).

**Uninstall**:

If you deactivate and delete Ad Inserter the settings will stay in the database. To completely remove the plugin and settings do the following:

1. Go to Ad Inserter Settings (tab *) and click on Reset All Settings
2. Deactivate Ad Inserter
3. Delete Ad Inserter plugin

== Frequently Asked Questions ==

= I have activated Ad Inserter. How can I use it? =

1. After activation, click "Settings / Ad Inserter" to access the settings page
2. Put ad (or any other HTML/Javascript/PHP) code into the ad box
3. Set automatic display option
5. Enable at least one page type: Posts, Static pages, Homepage, Category pages, Search Pages, Archive pages (some display options don't work on all page types)
4. Save settings


= Settings for widget =

*   Nothing needed, just enter the code and save settings - widget is enabled by default
*   Go to Appearance / Widgets, drag Ad Inserter widget to the sidebar or any other widget position, select code block and click on Save


= Settings for ad before the first paragraph on all posts =

*   Automatic Display: Before Paragraph
*   On all Posts checked, other page types unchecked
*   Paragraph number: 1


= Settings for ad before the second paragraph on all posts, but on the homepage only three ads in the first three post =

*   Automatic Display: Before Paragraph
*   On all Posts checked, Homepage checked, other page types unchecked
*   Paragraph number: 2
*   Filter: 1, 2, 3 (in some cases 2, 4, 6 - depends on the theme and needs some testing)


= Settings for ad wrapped with text of the third paragraph on all posts =

*   Automatic Display: Before Paragraph
*   On all Posts checked, other page types unchecked
*   Block Alignment and Style: Float Left
*   Paragraph number: 3


= Settings for centered ad in the middle of post paragraphs =

*   Automatic Display: Before Paragraph
*   On all Posts checked, other page types unchecked
*   Block Alignment and Style: Center
*   Paragraph number: 0.5


= Settings for ad above post excerpts on the Insurance category page =

*   Automatic Display: Before Post
*   Category pages checked, other page types unchecked
*   Click Lists button to display lists
*   Categories: Insurance, White List checked


= Settings for ad above the first and third post excerpts on the homepage =

*   Automatic Display: Before Excerpt
*   Homepage checked, other page types unchecked
*   Filter: 1, 3


= Settings for ad above the post excerpts on the Cars tag page =

*   Automatic Display: Before Post
*   Archive pages checked, other page types unchecked
*   Click Lists button to display lists
*   Tags: Cars, White List checked


= I wish to show ads side by side but not in the same block. How do I do this? =

Configure block 1 and 2 with ads using:

*   Automatic Display: None
*   Block Alignment and Style: No Wrapping
*   Enable shortcode: checked

Configure block 3 with

`[adinserter block="1"]
[adinserter block="2"]`

Use block 3 to display ads and make sure all 3 blocks are enabled for the same page types (Posts, Pages, Homepage, etc.).


= I use After Content display position but the code is inserted after the stuff provided by other plugins. How can I insert directly after post content?

This happens because Ad Inserter processes posts last and therefore "sees" also content added by other plugins.

Try to set Ad Inserter plugin priority to 10 (early processing, Ad Inserter settings - tab *).


= How can I replace deprecated tags {adinserter n} for manual insertion with new ones [adinserter block="n"] in all posts? =

Use <a href="https://wordpress.org/plugins/search-regex/" target="_blank">Search Regex</a> plugin to replace tags in all posts with few clicks. If you are not familiar with regular expressions simply use search and replace text for each code block. Use **Replace** to test replacements and when it works as expected use **Replace & Save**.


= How can I add some text or title (e.g. Advertisement) above the ad? =

If this is a sidebar widget then you can simply name the widget. In other cases you can add title HTML code above ad code. For example:

`<h3>Advertisement</h3>

AD_CODE`

Change title tag according to the theme style.


= I like the plugin. How can I support it? =

*   Write a nice <a href="http://wordpress.org/support/view/plugin-reviews/ad-inserter">review</a>
*   <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LHGZEMRTR7WB4">Donate</a>


= How can I enable/disable ads on specific posts/pages? =

There are two possible approaches.

*   Approach with page/post exceptions - use this one if there are many exceptions:

1. Go to Ad Inserter settings page and define default display options for post/page.
2. Enable automatic display on posts/pages and choose default display: **On all**, **On all except selected** or **Only on selected**.
3. Go to post/page editor and open **Ad Inserter Exceptions** meta box below.
4. Check default display options for wanted code blocks.
5. Set exceptions for this post or page.

*   Approach with code block settings only - use this one if there are only few exceptions:

1. Go to Ad Inserter settings page and define default display options for post/page.
2. Enable automatic display On all Posts/Pages.
3. Click on Lists, enter url (or space separated urls) for Urls, e.g. `/permalink-url`, and white-list or black-list it.


= I'm using responsive theme. How can I show or hide some ads on mobile devices? =

Select device types (desktop, tablet or phone) for which you need to show ads and enable **only client-side** device detection.


= Which device type detection should I use? =

In most cases you should use ONLY client-side detection. All code blocks are generated, however, they are displayed according to settings and browser's screen width using CSS Media Queries. This works perfectly in responsive designs.


= How can I disable ads for direct visitors? =

Blacklist `#` as referer for visitors that enter web address directly into browser (no referer).
Blacklist `yourdomain.com` as referer for visitors that browse your website yourdomain.com.
To blacklist both enter `yourdomain.com, #`


= How can I disable ads on error 404 page? =

This is disabled by default. Uncheck Error 404 Page checkbox.


= How can I enable or disable ads on group of similar pages? =

If those pages have something in common in the url (page address) then you can block them with url patterns.
Use `*` to define url pattern to whitelist (enable) or blacklist (disable).

1. To filter all urls starting with **/url-start** use `/url-start*`
2. To filter all urls that contain **url-pattern** use `*url-pattern*`
3. To filter all urls ending with **url-end** use `*url-end`

For example, to exclude ads on pages that have /shop/ in url (page address) blacklist the following url: `*/shop/*`

**WARNING:** Separate urls with SPACES.


= How can I put an ad in the middle of the post regardless of the number of paragraphs? =

Put 0.5 as paragraph number. Value between 0 and 1 means relative position in post or page (e.g. 0.3 means paragraph 30% from top or bottom)


= I'd like to rotate my ad codes based on percentage, for example show one ad 75% of the time and another one 25% of the time. Is that possible? =

Yes, simply create block with 4 ads separated with |rotate|: 3 times ad1 and 1 time ad2.


= How can I show different ads to different visitors according to a url query parameter? =

For example, use the following code for block 1 and enable PHP processing for this block:

`<?php
if (isset ($_GET ['src'])) {
  switch ($_GET ['src']) {
    case 'email':
        echo adinserter (2);
        break;
    case 'facebook':
        echo adinserter (3);
        break;
    case 'twitter':
        echo adinserter (4);
        break;
    default:
        echo adinserter (5);
  }
} else echo adinserter (6); // no src parameter
?>`


= How can I use PHP code for code block? =

Enter PHP code surrounded by PHP tags and check Process PHP.
Example:

`<div style="width: 100%;">
Some HTML/Javascript code
</div>
<?php echo "PHP code by Ad Inserter"; ?>`


= How can I insert post category name into my ad code? =

1. Use {category} in the ad. This will be replaced with the post category name.
2. You can also use

*   {title} - Title of the post
*   {short_title} - Short title (first 3 words) of the post title
*   {category} - Category of the post (or short title if there is no category)
*   {short_category} - First words before "," or "and" of the category of the post (or short title if there is no category)
*   {tag} - The first tag or general tag if the post has no tags (**works only inside posts**)
*   {smart_tag} - Smart selection of post tag in the following order:
  *   If there is no tag then the category is used;
  *   If there is a two-word tag then it is used;
  *   If the first tag is a substring of the second (or vice versa) then the first tag is not taken into account
  *   If the first and second tags are single words then both words are used
  *   First three words of the first tag
  *   General tag
*   {search_query} - Search engine query that brought visitor to your website (supports Google, Yahoo, Bing and Ask search engines), {smart_tag} is used when there is no search query. You need to disable caching to use this tag. Please note that most search queries are now encrypted.
*   {author} - Post author username (**works only inside posts**)
*   {author_name} Post author name (**works only inside posts**)


= How can I rotate few versions of the same ad? =

Enter them into the ad box and separate them with |rotate| (vertical bars around text rotate). Ad Inserter will display them randomly.
Example:

`ad_code_1
|rotate|
ad_code_2
|rotate|
ad_code_3`


= How can place ads below Read More tag? =

Configure ad block with the following options:

*   Automatic display: After Paragraph
*   Paragraph Number: 1
*   Count only paragraphs that CONTAIN: `<span id="more-`

Check source code of your website for proper "read more" tag.


= How can I insert code block directly into template php file? =

Enable PHP function adinserter for code block and call adinserter function with code block number as parameter.
Example for block 3:

`<?php if (function_exists ('adinserter')) echo adinserter (3); ?>`

This would generate code as defined for the code block number 3.


= How can I create contextual Amazon ad (to show items related to the post)? =

Sign in to Amazon Associates, go to Widgets/Widget Source, choose ad type and set parameters.
For titles and search terms use tags. For example, the code below would display amazon products related to the post tags - check above for all possible tags.


Example for Amazon Native Shopping Ads (use your own tracking id):

`<script type="text/javascript">
amzn_assoc_placement = "adunit0";
amzn_assoc_search_bar = "true";
amzn_assoc_tracking_id = "ad-inserter-20";
amzn_assoc_search_bar_position = "top";
amzn_assoc_ad_mode = "search";
amzn_assoc_ad_type = "smart";
amzn_assoc_marketplace = "amazon";
amzn_assoc_region = "US";
amzn_assoc_title = "Search Results from Amazon";
amzn_assoc_default_search_phrase = "{smart_tag}";
amzn_assoc_default_category = "All";
amzn_assoc_linkid = "cf1873f027a57f63cede634cfd444bea";
</script>
<script src="//z-na.amazon-adsystem.com/widgets/onejs?MarketPlace=US"></script>`


= Center alignment does not work for some ads! =

Some iframe ads can not be centered using standard approach so some additional code is needed to put them in the middle.
Simply wrap ad code in a div with some style e.g. left padding. Example:

`<div style="padding-left: 200px;">
ad_code
</div>`


= How can I rotate between different alignments so I can test an ad aligned to the right against an ad aligned to the left? =

Set Block Alignment and Style to "No Wrapping" and create manual wrapping around both ads separated with |rotate|:

`<div style="float: left; margin: 0 8px 8px 0;">
AD CODE LEFT
</div>

|rotate|

<div style="float: right; margin: 0 0 8px 8px;">
AD CODE RIGHT
</div>`


== Screenshots ==

1. Settings for one code block (Before post). Up to 16 blocks can be configured (up to 64 in <a href="http://tinymonitor.com/ad-inserter-pro" target="_blank">Ad Inserter Pro</a>)
2. Complete settings for one code block (Before Paragraph)
3. Alignment **Left**, **None** - None means default (usually left) aligned ad block with thin margin around
4. Alignment **Right** - Right aligned ad block with thin margin around
5. Alignment **Center** - Center aligned ad block with thin margin around
6. Alignment **No Wrapping** - Default (usually left) aligned ad block **with no margin around**
7. Alignment **Custom CSS** - Ad block with custom CSS (no margin around). You can use it for special effects (border, background, padding, margin, floating, etc.)
8. Alignment **Float Left** - Left aligned ad block with thin margin around wrapped with text on the right
9. Alignment **Float Right** - Right aligned ad block with thin margin around wrapped with text on the left
10. Ad Inserter settings
11. Post / Page Ad Inserter Exceptions
12. Code preview with visual CSS editor
13. Code preview with visual CSS editor - highlighted code


== Changelog ==


= 2.0.3 =
- Debugging functions in admin toolbar available only for administrators
- Added option to hide debugging functions in admin toolbar
- Added shortcode for debugger
- Few minor bug fixes

= 2.0.2 =
- Changed javascript version check to get plugin version from the HTML page
- Added warning if old cached version of CSS file is loaded on the settings page
- Added warning if version query parameter for js/css files is removed due to inappropriate caching

= 2.0.1 =
- Bug fix: Shortcodes called by name were not displayed

= 2.0.0 =
- Redesigned user interface
- Added many debugging tools for easier troubleshooting
- New feature: Code preview tool with visual CSS editor
- New feature: Label inserted blocks
- New feature: Show available positions for automatic insertion
- New feature: Show HTML tags in posts/static pages
- New feature: Log Ad Inserter processing
- Improved loading speed of the settings page
- Improved block insertion processing speed
- Added support to avoid inserion near images, headers and other elements
- Added option to avoid insertion in feeds
- Added option to display code blocks only to administrators
- Added option for publishig date check for display positions Before/After Content
- Added option for server-side device check for header and footer code
- Added option for maximum page/post words
- Added option for maximum paragraph words
- Added option to black/white-list post IDs
- Added option to black/white-list url query parameters
- Added warning if the settings page is blocked by ad blocker
- Added warning if old cached version of javascript is loaded on the settings page
- Added support for multisite installations to disable settings, widgets and exceptions on network sites (Pro only)
- Block names can be edited by clicking on the name
- Filters now work also on posts and single pages
- CSS code for client-side detection moved to inline CSS
- Bug fix: Minimum user roles for exception editing was not calculated properly
- Bug fix: Server-side detection checkbox was not saved properly
- Many other minor bug fixes, code improvements and cosmetic changes

= 1.7.0 =
- Bug fix: Shortcodes did not ignore post/static page exceptions
- Slightly redesigned user interface
- Excerpt/Post number(s) renamed to Filter as it now works on all display positions
- Widget setting removed from Automatic display to Manual display section
- Added support to disable widgets (standalone checkbox in Manual display)
- Added call counter/filter for widgets
- Added support to edit CSS for predefined styles
- Few other minor bug fixes, code improvements and cosmetic changes

= 1.6.7 =
- Bug fix: Block code textarea was not escaped
- Added checks for page types for shortcodes
- Added support for Before/After Post position call counter/filter
- Few minor cosmetic changes

= 1.6.6 =
- Bug fix: Display on Homepage and other blog pages might get disabled - important if you were using PHP function call or shortcode (import of settings from 1.6.4)
- Few minor cosmetic changes
- Requirements changed to WordPress 4.0 or newer
- Added initial support for Pro version

= 1.6.5 =
- Fixed bug: Wrong counting of max insertions
- Change: display position Before Title was renamed to Before Post
- Added support for display position After Post
- Added support for posts with no `<p>` tags (paragraphs separated with \r\n\r\n characters)
- Added support for paragraph processing on homepage, category, archive and search pages
- Added support for custom viewports
- Added support for PHP function call counter
- Added support to disable code block on error 404 pages
- Added support to debug paragraph tags

= 1.6.4 =
- Fixed bug: For shortcodes in posts the url was not checked
- Optimizations for device detection

= 1.6.3 =
- Removed deprecated code (fixes PHP 7 deprecated warnings)
- Added support for paragraphs with div and other HTML tags (h1, h2, h3,...)

= 1.6.2 =
- Removed deprecated code (fixes PHP Fatal error Call to a member function get_display_type)
- Added support to change plugin processing priority

= 1.6.1 =
* Fixed bug: For shortcodes in posts the date was not checked
* Fixed error with some templates "Call to undefined method is_main_query()"
* Added support for minumum number of page/post words for Before/After content display option
* Added support for {author} and {author_name} tags

= 1.6.0 =
* Added support for client-side device detection
* Many code improvements
* Improved plugin processing speed
* Removed support for deprecated tags for manual insertion {adinserter n}
* Few minor bug fixes

= 1.5.8 =
* Fixed notice "Undefined index: adinserter_selected_block_" when saving page or post

= 1.5.7 =
* Fixed notice "has_cap was called with an argument that is deprecated since version 2.0!"
* Few minor bug fixes and code improvements
* Added support to blacklist or whitelist url patterns: /url-start*. *url-pattern*, *url-end
* Added support to define minimum number of words in paragraphs
* Added support to define minimum user role for page/post Ad Inserter exceptions editing
* Added support to limit insertions of individual code blocks
* Added support to filter direct visits (no referer)

= 1.5.6 =
* Fixed Security Vulnerability: Plugin was vulnerable to Cross-Site Scripting (XSS)
* Few bug fixes and code improvements

= 1.5.5 =
* Few bug fixes and code improvements
* Added support to export and import all Ad Inserter settings

= 1.5.4 =
* Many code optimizations and cosmetic changes
* Header and Footer code blocks moved to settings tab (*)
* Added support to process shortcodes of other plugins used in Ad Inserter code blocks
* Added support to white-list or black-list individual urls
* Added support to export and import settings for code blocks
* Added support to specify excerpts for block insertion
* Added support to specify text that must be present when counting paragraphs

= 1.5.3 =
* Fixed Security Vulnerability: Plugin was vulnerable to a combination of CSRF/XSS attacks (credits to Kaustubh Padwad)
* Fixed bug: In some cases deprecated widgets warning reported errors
* Added support to white-list or black-list tags
* Added support for category slugs in category list
* Added support for relative paragraph positions
* Added support for individual code block exceptions on post/page editor page
* Added support for minimum number of words
* Added support to disable syntax highlighting editor (to allow using copy/paste on mobile devices)

= 1.5.2 =
* Fixed bug: Widget titles might be displayed at wrong sidebar positions
* Change: Default code block CSS class name was changed from ad-inserter to code-block to prevent Ad Blockers from blocking Ad Inserter divs
* Added warning message if deprecated widgets are used
* Added support to display blocks on desktop + tablet and desktop + phone devices

= 1.5.1 =
* Few fixes to solve plugin incompatibility issues
* Added support to disable all ads on specific page

= 1.5.0 =
* Added support to display blocks on all, desktop or mobile devices
* Added support for new widgets API - one widget for all code blocks with multiple instances
* Added support to change wrapping code CSS class name
* Fixed bug: Display block N days after post is published was not working properly
* Fixed bug: Display block after paragraph in some cases was not working propery

= 1.4.1 =
* Fixed bug: Code blocks configured as widgets were not displayed properly on widgets admin page

= 1.4.0 =
* Added support to skip paragraphs with specified text
* Added position After paragraph
* Added support for header and footer scripts
* Added support for custom CSS styles
* Added support to display blocks to all, logged in or not logged in users
* Added support for syntax highlighting
* Added support for shortcodes
* Added classes to block wrapping divs
* Few bugs fixed

= 1.3.5 =
* Fixed bug: missing echo for PHP function call example

= 1.3.4 =
* Added option for no code wrapping with div
* Added option to insert block codes from PHP code
* Changed HTML codes to disable display on specific pages
* Selected code block position is preserved after settings are saved
* Manual insertion can be enabled or disabled regardless of primary display setting
* Fixed bug: in some cases Before Title display setting inserted code into RSS feed

= 1.3.3 =
* Added option to insert ads also before or after the excerpt
* Fixed bug: in some cases many errors reported after activating the plugin
* Few minor bugs fixed
* Few minor cosmetic changes

= 1.3.2 =
* Fixed blank settings page caused by incompatibility with some themes or plugins

= 1.3.1 =
* Added option to insert ads also on pages
* Added option to process PHP code
* Few bugs fixed

= 1.3.0 =
* Number of ad slots increased to 16
* New tabbed admin interface
* Ads can be manually inserted also with {adinserter AD_NUMBER} tag
* Fixed bug: only the last ad block set to Before Title was displayed
* Few other minor bugs fixed
* Few cosmetic changes

= 1.2.1 =
* Fixed problem: || in ad code (e.g. asynchronous code for AdSense) causes only part of the code to be inserted (|| to rotate ads is replaced with |rotate|)

= 1.2.0 =
* Fixed bug: manual tags in posts lists were not removed
* Added position Before title
* Added support for minimum number of paragraphs
* Added support for page display options for Widget and Before title positions
* Alignment now works for all display positions

= 1.1.3 =
* Fixed bug for {search_query}: When the tag is empty {smart_tag} is used in all cases
* Few changes in the settings page

= 1.1.2 =
* Fixed error with multisite/network installations

= 1.1.1 =
* Fixed bug in Float Right setting display

= 1.1.0 =
* Added option to manually display individual ads
* Added new ad alignments: left, center, right
* Added {search_query} tag
* Added support for category black list and white list

= 1.0.4 =
* HTML entities for {title} and {short_title} are now decoded
* Added {tag} to display the first tag

= 1.0.3 =
* Fixed bug with rotating ads

= 1.0.2 =
* Added support for rotating ads

= 1.0.1 =
* Added support for different sidebar implementations

= 1.0.0 =
* Initial release


== Upgrade Notice ==

= 2.0.3 =
Debugging functions in admin toolbar available only for administrators;
Added option to hide debugging functions in admin toolbar;
Added shortcode for debugger;
Few minor bug fixes

= 2.0.2 =
Changed javascript version check to get plugin version from the HTML page;
Added warning if old cached version of CSS file is loaded on the settings page;
Added warning if version query parameter for js/css files is removed due to inappropriate caching

= 2.0.1 =
Bug fix: Shortcodes called by name were not displayed

= 2.0.0 =
Redesigned user interface;
Added many debugging tools for easier troubleshooting;
New feature: Code preview tool with visual CSS editor;
New feature: Label inserted blocks;
New feature: Show available positions for automatic insertion;
New feature: Show HTML tags in posts/static pages;
New feature: Log Ad Inserter processing;
Improved loading speed of the settings page;
Improved block insertion processing speed;
Added support to avoid inserion near images, headers and other elements;
Added option to avoid insertion in feeds;
Added option to display code blocks only to administrators;
Added option for publishig date check for display positions Before/After Content;
Added option for server-side device check for header and footer code;
Added option for maximum page/post words;
Added option for maximum paragraph words;
Added option to black/white-list post IDs;
Added option to black/white-list url query parameters;
Added warning if the settings page is blocked by ad blocker;
Added warning if old cached version of javascript is loaded on the settings page;
Added support for multisite installations to disable settings, widgets and exceptions on network sites (Pro only);
Block names can be edited by clicking on the name;
Filters now work also on posts and single pages;
CSS code for client-side detection moved to inline CSS;
Bug fix: Minimum user roles for exception editing was not calculated properly;
Bug fix: Server-side detection checkbox was not saved properly;
Many other minor bug fixes, code improvements and cosmetic changes;

= 1.7.0 =
Bug fix: Shortcodes did not ignore post/static page exceptions;
Slightly redesigned user interface;
Excerpt/Post number(s) renamed to Filter as it now works on all display positions;
Widget setting removed from Automatic display to Manual display section;
Added support to disable widgets (standalone checkbox in Manual display);
Added call counter/filter for widgets;
Added support to edit CSS for predefined styles;
Few other minor bug fixes, code improvements and cosmetic changes;

= 1.6.7 =
Bug fix: Block code textarea was not escaped;
Added checks for page types for shortcodes;
Added support for Before/After Post position call counter/filter;
Few minor cosmetic changes

= 1.6.6 =
Bug fix: Display on Homepage and other blog pages might get disabled - important if you were using PHP function call or shortcode (import of settings from 1.6.4)
Few minor cosmetic changes;
Requirements changed to WordPress 4.0 or newer;
Added initial support for Pro version

= 1.6.5 =
Fixed bug: Wrong counting of max insertions;
Change: display position Before Title was renamed to Before Post;
Added support for display position After Post;
Added support for posts with no `<p>` tags (paragraphs separated with \r\n\r\n characters);
Added support for paragraph processing on homepage, category, archive and search pages;
Added support for custom viewports;
Added support for PHP function call counter;
Added support to disable code block on error 404 pages;
Added support to debug paragraph tags

= 1.6.4 =
Fixed bug: For shortcodes in posts the url was not checked;
Optimizations for device detection

= 1.6.3 =
Removed deprecated code (fixes PHP Fatal error Call to a member function get_display_type);
Added support to change plugin processing priority

= 1.6.2 =
Removed deprecated code (fixes PHP Fatal error Call to a member function get_display_type);
Added support to change plugin processing priority

= 1.6.1 =
Fixed bug: For shortcodes in posts the date was not checked;
Fixed error with some templates "Call to undefined method is_main_query()";
Added support for minumum number of page/post words for Before/After content display option;
Added support for {author} and {author_name} tags

= 1.6.0 =
Added support for client-side device detection;
Many code improvements;
Improved plugin processing speed;
Removed support for deprecated tags for manual insertion {adinserter n};
Few minor bug fixes

= 1.5.8 =
Fixed notice "Undefined index: adinserter_selected_block_" when saving page or post

= 1.5.7 =
Fixed notice "has_cap was called with an argument that is deprecated since version 2.0!";
Few minor bug fixes and code improvements;
Added support to blacklist or whitelist url patterns: /url-start*. *url-pattern*, *url-end;
Added support to define minimum number of words in paragraphs;
Added support to define minimum user role for page/post Ad Inserter exceptions editing;
Added support to limit insertions of individual code blocks;
Added support to filter direct visits (no referer)

= 1.5.6 =
Fixed Security Vulnerability: Plugin was vulnerable to Cross-Site Scripting (XSS);
Few bug fixes and code improvements

= 1.5.5 =
Few bug fixes and code improvements;
Added support to export and import all Ad Inserter settings

= 1.5.4 =
Many code optimizations and cosmetic changes;
Header and Footer code blocks moved to settings tab (*);
Added support to process shortcodes of other plugins used in Ad Inserter code blocks;
Added support to white-list or black-list individual urls;
Added support to export and import settings for code blocks;
Added support to specify excerpts for block insertion;
Added support to specify text that must be present when counting paragraphs

= 1.5.3 =
Fixed Security Vulnerability (CSRF/XSS attacks);
Fixed bug where deprecated widgets warning reported errors;
Added support to white-list or black-list tags;
Added support for category slugs in category list;
Added support for relative paragraph positions;
Added support for individual code block exceptions on post/page editor page;
Added support for minimum number of words;
Added support to disable syntax highlighting editor (to allow using copy/paste on mobile devices)

= 1.5.2 =
Fixed bug: Widget titles might be displayed at wrong sidebar positions;
Change: Default code block CSS class name changed to code-block;
Warning message if deprecated widgets are used;
Display blocks on desktop + tablet and desktop + phone devices

= 1.5.1 =
Few fixes to solve plugin incompatibility issues;
Support to disable all ads on specific page

= 1.5.0 =
Display blocks on all, desktop or mobile devices;
New widgets API - one widget for all code blocks with multiple instances - PLEASE REPLACE ALL OLD WIDGETS WITH THE NEW ONE!
Wrapping code CSS class name can be changed;
Fixed bug: Display block N days after post is published;
Fixed bug: Display block after paragraph

= 1.4.1 =
Fixed bug: Code blocks configured as widgets were not displayed properly on widgets admin page

= 1.4.0 =
Added support to skip paragraphs with specified text
Added position After paragraph
Added support for header and footer scripts
Added support for custom CSS styles
Added support to display blocks to all, logged in or not logged in users
Added support for syntax highlighting
Added support for shortcodes
Added classes to block wrapping divs
Few bugs fixed

= 1.3.5 =
Fixed bug: missing echo for PHP function call example

= 1.3.4 =
Fixed bug: in some cases Before Title display setting inserted code into RSS feed,
Selected code block position is preserved after settings are saved,
Added option for no code wrapping with div,
Added option to insert block codes from PHP code,
Changed HTML codes to disable display on specific pages,
Manual insertion can be enabled or disabled regardless of primary display setting

= 1.3.3 =
Fixed bug: in some cases many errors reported after activating the plugin,
Added option to insert ads also before or after the excerpt,
Few minor bugs fixed,
Few minor cosmetic changes

= 1.3.2 =
Fixed blank settings page caused by incompatibility with some themes or plugins

= 1.3.1 =
Added option to insert ads also on pages,
Added option to process PHP code,
Few bugs fixed

= 1.3.0 =
Number of ad slots increased to 16,
New tabbed admin interface,
Ads can be manually inserted also with {adinserter AD_NUMBER} tag,
Fixed bug: only the last ad block set to Before Title was displayed,
Few other minor bugs fixed,
Few cosmetic changes

= 1.2.1 =
Fixed problem: || in ad code (e.g. asynchronous code for AdSense) causes only part of the code to be inserted (|| to rotate ads is replaced with |rotate|)

= 1.2.0 =
Fixed bug: manual tags in posts lists were not removed,
Added position Before title,
Added support for minimum number of paragraphs,
Added support for page display options for Widget and Before title positions,
Alignment now works for all display positions,

= 1.1.3 =
Fixed bug for search query tag

= 1.1.2 =
Fixed error with multisite/network installations

= 1.1.1 =
Fixed bug in Float Right setting display

= 1.1.0 =
Added new features

= 1.0.4 =
Added few minor features

= 1.0.3 =
Fixed bug with rotating ads

= 1.0.2 =
Support for rotating ads

= 1.0.1 =
Support for different sidebar implementations in various themes

= 1.0.0 =
Initial release


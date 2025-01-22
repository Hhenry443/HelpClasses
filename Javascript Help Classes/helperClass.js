/**
 * Utility class
 * 
 * A collection of helper functions. Very useful!
 * 
 * To use, just include this script in any page you want it to work on and use the methods.
 * 
 * You do not need to instantiate this class to use its methods.
 * 
 * For example (in the file you want to use the class):
 * Utility.redirect('https://example.com');
 * 
 * This should be useful for most projects. 
 * I will be back... To add more functions.
 * 
 * Whenever I make a project that needs a new helper I deem useful, I will add it here.
 * 
 * This is a very useful class. You should use it.
 * 
 * GLHF! 
 * 
 * - Past Henry
 * D.O.C 22/1/2025
 * 
 */

class Utility {
    /**
     * Inspect a value(s)
     * 
     * @param {any} value
     * @return {void}
     */
    static inspect(value) {
        console.log(value);
    }

    /**
     * Inspect a value(s) and terminate the script
     * 
     * @param {any} value
     * @return {void}
     */
    static inspectAndDie(value) {
        console.log(value);
        throw new Error("Terminated script");
    }

    /**
     * Format salary
     *
     * @param {string} salary
     * @return {string} Formatted salary
     */
    static formatSalary(salary) {
        return `£${Number(salary).toLocaleString()}`;
    }

    /**
     * Sanitize data
     * 
     * @param {string} dirty
     * @return {string}
     */
    static sanitise(dirty) {
        return dirty.trim().replace(/[^\x20-\x7E]/g, "");
    }

    /**
     * Redirect to a given URL
     * 
     * @param {string} url
     * @return {void}
     */
    static redirect(url) {
        window.location.href = url;
    }

    /**
     * Generate a random string
     * 
     * @param {number} length
     * @return {string}
     */
    static randomString(length = 16) {
        return Array.from(crypto.getRandomValues(new Uint8Array(length / 2)))
            .map(byte => byte.toString(16).padStart(2, '0'))
            .join('');
    }

    /**
     * Check if a value is JSON
     * 
     * @param {string} string
     * @return {boolean}
     */
    static isJson(string) {
        try {
            JSON.parse(string);
            return true;
        } catch (e) {
            return false;
        }
    }

    /**
     * Format a date
     * 
     * @param {string} date
     * @param {string} format
     * @return {string}
     */
    static formatDate(date, format = 'YYYY-MM-DD') {
        const d = new Date(date);
        return d.toISOString().split('T')[0];
    }

    /**
     * Log debug messages
     * 
     * @param {string} message
     * @param {string} file
     * @return {void}
     */
    static logDebug(message, file = 'debug.log') {
        const time = new Date().toISOString();
        console.log(`[${time}] ${message}`);
    }

    /**
     * Check if a string contains a substring
     * 
     * @param {string} haystack
     * @param {string} needle
     * @return {boolean}
     */
    static contains(haystack, needle) {
        return haystack.includes(needle);
    }

    /**
     * Sanitize an array of data
     * 
     * @param {Array} data
     * @return {Array}
     */
    static sanitiseArray(data) {
        return data.map(item => this.sanitise(item));
    }

    /**
     * Pluralize a word based on count
     * 
     * @param {string} word
     * @param {number} count
     * @return {string}
     */
    static pluralize(word, count) {
        return count === 1 ? word : word + 's';
    }
}

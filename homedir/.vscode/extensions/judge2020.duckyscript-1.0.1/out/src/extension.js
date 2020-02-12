'use strict';
Object.defineProperty(exports, "__esModule", { value: true });
// The module 'vscode' contains the VS Code extensibility API
// Import the module and reference it with the alias vscode in your code below
const vscode = require("vscode");
// this method is called when your extension is activated
// your extension is activated the very first time the command is executed
class GoHoverProvider {
    provideHover(document, position, token) {
        let wordRange = document.getWordRangeAtPosition(position);
        let hoveredText = document.getText(wordRange);
        let hoverText = "";
        switch (hoveredText) {
            case "REM":
                hoverText = "Comment block. Use to note your code.";
                break;
            case "DEFAULT_DELAY" || "DEFAULTDELAY":
                hoverText = "Sets the delay in milliseconds between each command proceeding this line.";
                break;
            case "DELAY":
                hoverText = "Delays the script for x milliseconds.";
                break;
            case "STRING":
                hoverText = "Types the following alphanumeric keys on the clipboard.";
                break;
            case "GUI" || "WINDOWS":
                hoverText = "Presses the Windows (super) key. Cmd on MacOS. \n Accepts one optional character as argument.";
                break;
            case "APP" || "MENU":
                hoverText = "Opens the context menu for the current window. Similar to Right-click.";
                break;
            case "SHIFT":
                hoverText = "(literal) presses the SHIFT key. \n Optional Paramaters: DELETE, HOME, INSERT, PAGEUP, PAGEDOWN, WINDOWS, GUI, UPARROW, DOWNARROW, LEFTARROW, RIGHTARROW, TAB";
                break;
            case "ALT":
                hoverText = "(literal) presses the ALT key. \n Optional Paramaters: END, ESC, ESCAPE, F1...F12, Single Char, SPACE, TAB";
                break;
            case "CONTROL" || "CTRL":
                hoverText = "(literal) presses the CTRL key. \n Optional Paramaters: BREAK, PAUSE, F1...F12, ESCAPE, ESC, Single Char";
                break;
            case "DOWNARROW" || "DOWN" || "LEFT" || "LEFTARROW" || "RIGHTARROW" || "RIGHT" || "UPARROW" || "UP":
                hoverText = "(literal) presses the corresponding arrow key.";
                break;
            case "BREAK" || "PAUSE":
                hoverText = "Presses the break key. Great for CTRL BREAK combo.";
                break;
            case "CAPSLOCK":
                hoverText = "(literal) Toggles CAPS lock. This alone is a good prank around the office.";
                break;
            case "DELETE":
                hoverText = "(literal) Presses delete key.";
                break;
            case "END":
                hoverText = "(literal) Presses end key.";
                break;
            case "ESC" || "ESCAPE":
                hoverText = "(literal) Presses escape key";
                break;
            case "HOME":
                hoverText = "(literal) Presses home key.";
                break;
            case "INSERT":
                hoverText = "(literal) presses insert.";
                break;
            case "NUMLOCK":
                hoverText = " (literal) presses num lock.";
                break;
            case "PAGEUP" || "PAGEDOWN":
                hoverText = "(literal) presses page down key.";
                break;
            case "PRINTSCREEN":
                hoverText = "Takes a screenshot and saves to clipboard";
                break;
            case "SCROLLLOCK":
                hoverText = "Only useful in MS office.";
                break;
            case "SPACE":
                hoverText = "Space key. does the same as `STRING  `";
                break;
            case "TAB":
                hoverText = "tab key.";
                break;
            case "REPLAY":
                hoverText = "Replays the past command. \n Paramaters: number of times.";
                break;
        }
        return Promise.resolve(new vscode.Hover(hoverText));
    }
}
function activate(ctx) {
    const ID = { language: 'ducky' };
    ctx.subscriptions.push(vscode.languages.registerHoverProvider(ID, new GoHoverProvider()));
}
exports.activate = activate;
// this method is called when your extension is deactivated
function deactivate() {
}
exports.deactivate = deactivate;
//# sourceMappingURL=extension.js.map
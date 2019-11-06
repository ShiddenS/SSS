import { ceScrollerInit } from "./scroller";
import { ceDialogInit } from "./dialog_opener";
import { ceAccordionInit } from "./accordion";
import { ceEditorInit } from "./editor";
import { cePreviewerInit } from "./previewer";
import { ceProgressInit } from "./progress";
import { ceHistoryInit } from "./history";
import { ceHintInit } from "./hint";
import { ceTooltipInit } from "./tooltips";
import { ceSortableInit } from "./sortables";
import { ceColorpickerInit } from "./color_picker";
import { ceFormValidatorInit } from "./form_validator";
import { ceRebuildStatesInit } from "./rebuild_states";
import { ceStickyScrollInit } from "./sticky_scroll";
import { ceNotificationInit } from "./notifications";
import { ceEventInit } from "./events";
import { ceCodeEditorInit } from "./code_editor";
import { ceObjectSelectorInit } from "./object_selector";
import { ceInsertAtCaretInit } from "./insert_at_caret";
import { ceSwitchCheckboxInit } from "./switch_checkbox";
import { ceCheckboxGroupInit} from './checkbox_group';
import { ceBlockManagerInit} from './block_manager';
import { ceBlockLoaderInit } from './block_loader';

/**
 * @param {JQueryStatic} $ 
 */
export const registerAllPlugins = function ($) {
    ceScrollerInit($);
    ceDialogInit($);
    ceAccordionInit($);
    ceEditorInit($);
    cePreviewerInit($);
    ceProgressInit($);
    ceHistoryInit($);
    ceHintInit($);
    ceTooltipInit($);
    ceSortableInit($);
    ceColorpickerInit($);
    ceFormValidatorInit($);
    ceRebuildStatesInit($);
    ceStickyScrollInit($);
    ceNotificationInit($);
    ceEventInit($);
    ceCodeEditorInit($);
    ceObjectSelectorInit($);
    ceInsertAtCaretInit($);
    ceSwitchCheckboxInit($);
    ceCheckboxGroupInit($);
    ceBlockManagerInit($);
    ceBlockLoaderInit($);
}

/* __placeholder__ */

const { defineProps, defineSlots, defineEmits, defineExpose, defineModel, defineOptions, withDefaults, } = await import('vue');
let __VLS_modelEmitsType!: {};

const __VLS_componentsOption = {};

let __VLS_name!: 'HeaderNav';
function __VLS_template() {
let __VLS_ctx!: InstanceType<__VLS_PickNotAny<typeof __VLS_internalComponent, new () => {}>> & {
};
/* Components */
let __VLS_otherComponents!: NonNullable<typeof __VLS_internalComponent extends { components: infer C } ? C : {}> & typeof __VLS_componentsOption;
let __VLS_own!: __VLS_SelfComponent<typeof __VLS_name, typeof __VLS_internalComponent & (new () => { $slots: typeof __VLS_slots })>;
let __VLS_localComponents!: typeof __VLS_otherComponents & Omit<typeof __VLS_own, keyof typeof __VLS_otherComponents>;
let __VLS_components!: typeof __VLS_localComponents & __VLS_GlobalComponents & typeof __VLS_ctx;
/* Style Scoped */
type __VLS_StyleScopedClasses = {};
let __VLS_styleScopedClasses!: __VLS_StyleScopedClasses | keyof __VLS_StyleScopedClasses | (keyof __VLS_StyleScopedClasses)[];
/* CSS variable injection */
/* CSS variable injection end */
let __VLS_resolvedLocalAndGlobalComponents!: {}
;
__VLS_intrinsicElements.header;__VLS_intrinsicElements.header;
__VLS_intrinsicElements.nav;__VLS_intrinsicElements.nav;
__VLS_intrinsicElements.div;__VLS_intrinsicElements.div;__VLS_intrinsicElements.div;__VLS_intrinsicElements.div;__VLS_intrinsicElements.div;__VLS_intrinsicElements.div;
__VLS_intrinsicElements.a;__VLS_intrinsicElements.a;__VLS_intrinsicElements.a;__VLS_intrinsicElements.a;
__VLS_intrinsicElements.img;
__VLS_intrinsicElements.span;__VLS_intrinsicElements.span;
__VLS_intrinsicElements.ul;__VLS_intrinsicElements.ul;
__VLS_intrinsicElements.li;__VLS_intrinsicElements.li;
{
const __VLS_0 = __VLS_intrinsicElements["header"];
const __VLS_1 = __VLS_elementAsFunctionalComponent(__VLS_0);
const __VLS_2 = __VLS_1({ ...{ }, }, ...__VLS_functionalComponentArgsRest(__VLS_1));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_0, typeof __VLS_2> & Record<string, unknown>) => void)({ ...{ }, });
{
const __VLS_5 = __VLS_intrinsicElements["nav"];
const __VLS_6 = __VLS_elementAsFunctionalComponent(__VLS_5);
const __VLS_7 = __VLS_6({ ...{ }, class: ("bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800"), }, ...__VLS_functionalComponentArgsRest(__VLS_6));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_5, typeof __VLS_7> & Record<string, unknown>) => void)({ ...{ }, class: ("bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800"), });
{
const __VLS_10 = __VLS_intrinsicElements["div"];
const __VLS_11 = __VLS_elementAsFunctionalComponent(__VLS_10);
const __VLS_12 = __VLS_11({ ...{ }, class: ("flex flex-wrap justify-between items-center mx-auto max-w-screen-xl"), }, ...__VLS_functionalComponentArgsRest(__VLS_11));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_10, typeof __VLS_12> & Record<string, unknown>) => void)({ ...{ }, class: ("flex flex-wrap justify-between items-center mx-auto max-w-screen-xl"), });
{
const __VLS_15 = __VLS_intrinsicElements["a"];
const __VLS_16 = __VLS_elementAsFunctionalComponent(__VLS_15);
const __VLS_17 = __VLS_16({ ...{ }, href: ("https://flowbite.com"), class: ("flex items-center"), }, ...__VLS_functionalComponentArgsRest(__VLS_16));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_15, typeof __VLS_17> & Record<string, unknown>) => void)({ ...{ }, href: ("https://flowbite.com"), class: ("flex items-center"), });
{
const __VLS_20 = __VLS_intrinsicElements["img"];
const __VLS_21 = __VLS_elementAsFunctionalComponent(__VLS_20);
const __VLS_22 = __VLS_21({ ...{ }, src: ("https://flowbite.com/docs/images/logo.svg"), class: ("mr-3 h-6 sm:h-9"), alt: ("Flowbite Logo"), }, ...__VLS_functionalComponentArgsRest(__VLS_21));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_20, typeof __VLS_22> & Record<string, unknown>) => void)({ ...{ }, src: ("https://flowbite.com/docs/images/logo.svg"), class: ("mr-3 h-6 sm:h-9"), alt: ("Flowbite Logo"), });
const __VLS_23 = __VLS_pickFunctionalComponentCtx(__VLS_20, __VLS_22)!;
}
{
const __VLS_25 = __VLS_intrinsicElements["span"];
const __VLS_26 = __VLS_elementAsFunctionalComponent(__VLS_25);
const __VLS_27 = __VLS_26({ ...{ }, class: ("self-center text-xl font-semibold whitespace-nowrap dark:text-white"), }, ...__VLS_functionalComponentArgsRest(__VLS_26));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_25, typeof __VLS_27> & Record<string, unknown>) => void)({ ...{ }, class: ("self-center text-xl font-semibold whitespace-nowrap dark:text-white"), });
(__VLS_28.slots!).default;
const __VLS_28 = __VLS_pickFunctionalComponentCtx(__VLS_25, __VLS_27)!;
}
(__VLS_18.slots!).default;
const __VLS_18 = __VLS_pickFunctionalComponentCtx(__VLS_15, __VLS_17)!;
}
{
const __VLS_30 = __VLS_intrinsicElements["div"];
const __VLS_31 = __VLS_elementAsFunctionalComponent(__VLS_30);
const __VLS_32 = __VLS_31({ ...{ }, class: ("flex items-center lg:order-2"), }, ...__VLS_functionalComponentArgsRest(__VLS_31));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_30, typeof __VLS_32> & Record<string, unknown>) => void)({ ...{ }, class: ("flex items-center lg:order-2"), });
const __VLS_33 = __VLS_pickFunctionalComponentCtx(__VLS_30, __VLS_32)!;
}
{
const __VLS_35 = __VLS_intrinsicElements["div"];
const __VLS_36 = __VLS_elementAsFunctionalComponent(__VLS_35);
const __VLS_37 = __VLS_36({ ...{ }, class: ("hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1"), id: ("mobile-menu-2"), }, ...__VLS_functionalComponentArgsRest(__VLS_36));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_35, typeof __VLS_37> & Record<string, unknown>) => void)({ ...{ }, class: ("hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1"), id: ("mobile-menu-2"), });
{
const __VLS_40 = __VLS_intrinsicElements["ul"];
const __VLS_41 = __VLS_elementAsFunctionalComponent(__VLS_40);
const __VLS_42 = __VLS_41({ ...{ }, class: ("flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0"), }, ...__VLS_functionalComponentArgsRest(__VLS_41));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_40, typeof __VLS_42> & Record<string, unknown>) => void)({ ...{ }, class: ("flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0"), });
{
const __VLS_45 = __VLS_intrinsicElements["li"];
const __VLS_46 = __VLS_elementAsFunctionalComponent(__VLS_45);
const __VLS_47 = __VLS_46({ ...{ }, }, ...__VLS_functionalComponentArgsRest(__VLS_46));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_45, typeof __VLS_47> & Record<string, unknown>) => void)({ ...{ }, });
{
const __VLS_50 = __VLS_intrinsicElements["a"];
const __VLS_51 = __VLS_elementAsFunctionalComponent(__VLS_50);
const __VLS_52 = __VLS_51({ ...{ }, href: ("#"), class: ("block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white"), "aria-current": ("page"), }, ...__VLS_functionalComponentArgsRest(__VLS_51));
({} as (props: __VLS_FunctionalComponentProps<typeof __VLS_50, typeof __VLS_52> & Record<string, unknown>) => void)({ ...{ }, href: ("#"), class: ("block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white"), "aria-current": ("page"), });
(__VLS_53.slots!).default;
const __VLS_53 = __VLS_pickFunctionalComponentCtx(__VLS_50, __VLS_52)!;
}
(__VLS_48.slots!).default;
const __VLS_48 = __VLS_pickFunctionalComponentCtx(__VLS_45, __VLS_47)!;
}
(__VLS_43.slots!).default;
const __VLS_43 = __VLS_pickFunctionalComponentCtx(__VLS_40, __VLS_42)!;
}
(__VLS_38.slots!).default;
const __VLS_38 = __VLS_pickFunctionalComponentCtx(__VLS_35, __VLS_37)!;
}
(__VLS_13.slots!).default;
const __VLS_13 = __VLS_pickFunctionalComponentCtx(__VLS_10, __VLS_12)!;
}
(__VLS_8.slots!).default;
const __VLS_8 = __VLS_pickFunctionalComponentCtx(__VLS_5, __VLS_7)!;
}
(__VLS_3.slots!).default;
const __VLS_3 = __VLS_pickFunctionalComponentCtx(__VLS_0, __VLS_2)!;
}
if (typeof __VLS_styleScopedClasses === 'object' && !Array.isArray(__VLS_styleScopedClasses)) {
__VLS_styleScopedClasses["bg-white"];
__VLS_styleScopedClasses["border-gray-200"];
__VLS_styleScopedClasses["px-4"];
__VLS_styleScopedClasses["lg:px-6"];
__VLS_styleScopedClasses["py-2.5"];
__VLS_styleScopedClasses["dark:bg-gray-800"];
__VLS_styleScopedClasses["flex"];
__VLS_styleScopedClasses["flex-wrap"];
__VLS_styleScopedClasses["justify-between"];
__VLS_styleScopedClasses["items-center"];
__VLS_styleScopedClasses["mx-auto"];
__VLS_styleScopedClasses["max-w-screen-xl"];
__VLS_styleScopedClasses["flex"];
__VLS_styleScopedClasses["items-center"];
__VLS_styleScopedClasses["mr-3"];
__VLS_styleScopedClasses["h-6"];
__VLS_styleScopedClasses["sm:h-9"];
__VLS_styleScopedClasses["self-center"];
__VLS_styleScopedClasses["text-xl"];
__VLS_styleScopedClasses["font-semibold"];
__VLS_styleScopedClasses["whitespace-nowrap"];
__VLS_styleScopedClasses["dark:text-white"];
__VLS_styleScopedClasses["flex"];
__VLS_styleScopedClasses["items-center"];
__VLS_styleScopedClasses["lg:order-2"];
__VLS_styleScopedClasses["hidden"];
__VLS_styleScopedClasses["justify-between"];
__VLS_styleScopedClasses["items-center"];
__VLS_styleScopedClasses["w-full"];
__VLS_styleScopedClasses["lg:flex"];
__VLS_styleScopedClasses["lg:w-auto"];
__VLS_styleScopedClasses["lg:order-1"];
__VLS_styleScopedClasses["flex"];
__VLS_styleScopedClasses["flex-col"];
__VLS_styleScopedClasses["mt-4"];
__VLS_styleScopedClasses["font-medium"];
__VLS_styleScopedClasses["lg:flex-row"];
__VLS_styleScopedClasses["lg:space-x-8"];
__VLS_styleScopedClasses["lg:mt-0"];
__VLS_styleScopedClasses["block"];
__VLS_styleScopedClasses["py-2"];
__VLS_styleScopedClasses["pr-4"];
__VLS_styleScopedClasses["pl-3"];
__VLS_styleScopedClasses["text-white"];
__VLS_styleScopedClasses["rounded"];
__VLS_styleScopedClasses["bg-primary-700"];
__VLS_styleScopedClasses["lg:bg-transparent"];
__VLS_styleScopedClasses["lg:text-primary-700"];
__VLS_styleScopedClasses["lg:p-0"];
__VLS_styleScopedClasses["dark:text-white"];
}
var __VLS_slots!:{
};
return __VLS_slots;
}
const __VLS_internalComponent = (await import('vue')).defineComponent({
setup() {
return {
};
},
});
export default (await import('vue')).defineComponent({
setup() {
return {
};
},
});

type __VLS_IntrinsicElementsCompletion = __VLS_IntrinsicElements;

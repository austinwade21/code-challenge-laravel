/**
 * Viewport module for vuex store.
 *
 * Holds current viewport state based on user ui preference.
 */
export default {
    namespaced: true,
    state: {
        // CODE CHALLENGE: Dark Mode
        darkMode: true
    },
    getters: {
        isDarkMode: state => state.darkMode === true
    },
    mutations: {
        setDarkMode(state, value) {
            state.darkMode = value;
        }
    }
};

@extends('layouts.studio')

@section('title', 'TextFlow Studio - WordFix Premium')

@section('tool-title', 'TextFlow Studio')

@section('tool-description', 'Visual Text Processing Pipeline')

@section('tool-content')
<!-- Studio Container -->
<div class="h-full flex flex-col bg-gray-50" x-data="textFlowStudio()">
    
    <!-- Mobile Tabs -->
    <div class="lg:hidden flex border-b border-gray-200 bg-white">
        <button @click="activeTab = 'input'" :class="{'border-indigo-500 text-indigo-600': activeTab === 'input', 'border-transparent text-gray-500': activeTab !== 'input'}" class="flex-1 py-3 text-sm font-medium border-b-2 transition-colors">Input</button>
        <button @click="activeTab = 'flow'" :class="{'border-indigo-500 text-indigo-600': activeTab === 'flow', 'border-transparent text-gray-500': activeTab !== 'flow'}" class="flex-1 py-3 text-sm font-medium border-b-2 transition-colors">Pipeline</button>
        <button @click="activeTab = 'output'" :class="{'border-indigo-500 text-indigo-600': activeTab === 'output', 'border-transparent text-gray-500': activeTab !== 'output'}" class="flex-1 py-3 text-sm font-medium border-b-2 transition-colors">Result</button>
    </div>

    <div class="flex-1 flex flex-col lg:flex-row overflow-hidden">
        
        <!-- Left Pane: Input -->
        <div class="w-full lg:w-1/4 flex flex-col border-r border-gray-200 bg-white h-full" :class="{'hidden lg:flex': activeTab !== 'input'}">
            <div class="flex justify-between items-center p-3 border-b border-gray-100 bg-gray-50">
                <label class="text-xs font-bold text-gray-700 uppercase tracking-wider">Input Text</label>
                <span class="text-xs text-gray-500" x-text="inputStats"></span>
            </div>
            <textarea 
                x-model="inputText" 
                @input="processFlow()"
                class="flex-1 w-full p-4 text-sm border-0 focus:ring-0 resize-none font-mono text-gray-800 placeholder-gray-400" 
                placeholder="Paste your text here..."></textarea>
        </div>

        <!-- Middle Pane: Flow Builder -->
        <div class="w-full lg:w-2/4 flex flex-col bg-gray-50/50 h-full relative" :class="{'hidden lg:flex': activeTab !== 'flow'}">
            <!-- Magic Command Bar -->
            <div class="relative flex-shrink-0 p-4 z-20">
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-indigo-400 group-focus-within:text-indigo-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        x-model="commandQuery" 
                        @keydown.enter="parseCommand()"
                        class="block w-full pl-10 pr-12 py-3.5 border-0 rounded-xl leading-5 bg-white shadow-[0_2px_8px_rgba(0,0,0,0.08)] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all sm:text-sm font-medium text-gray-700" 
                        placeholder="Type a command (e.g. 'extract emails', 'sort desc')...">
                    <button 
                        @click="parseCommand()"
                        class="absolute inset-y-1 right-1 px-3 flex items-center justify-center bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Flow Canvas -->
            <div class="flex-1 px-4 pb-4 overflow-y-auto relative custom-scrollbar" 
                 @dragover.prevent 
                 @drop.prevent="handleDrop($event)">
                
                <!-- Empty State -->
                <div x-show="blocks.length === 0" class="absolute inset-0 flex flex-col items-center justify-center text-gray-400 pointer-events-none">
                    <div class="w-20 h-20 mb-4 rounded-2xl bg-indigo-50 flex items-center justify-center">
                        <svg class="w-10 h-10 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-gray-500">Drag blocks here or use the command bar</p>
                </div>

                <!-- Blocks List -->
                <div class="space-y-3 pb-24">
                    <template x-for="(block, index) in blocks" :key="block.id">
                        <div 
                            draggable="true"
                            @dragstart="dragStart(index)"
                            @dragenter="dragEnter(index)"
                            @dragend="dragEnd()"
                            class="bg-white rounded-xl shadow-[0_2px_4px_rgba(0,0,0,0.02)] border border-gray-100 p-4 relative group hover:shadow-md hover:border-indigo-100 transition-all duration-200"
                            :class="{'opacity-50 scale-95': draggingIndex === index, 'border-indigo-400 ring-2 ring-indigo-50': dragOverIndex === index}"
                        >
                            <!-- Block Header -->
                            <div class="flex justify-between items-center mb-3 cursor-move">
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-md bg-indigo-50 text-indigo-600 flex items-center justify-center text-xs font-bold font-mono" x-text="index + 1"></div>
                                    <span class="font-semibold text-gray-800 text-sm" x-text="block.name"></span>
                                </div>
                                <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button @click="removeBlock(index)" class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-md transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Block Controls -->
                            <div class="text-sm">
                                <!-- Filter Block -->
                                <template x-if="block.type === 'filter'">
                                    <div class="flex flex-col gap-2">
                                        <div class="flex gap-2">
                                            <select x-model="block.params.mode" @change="processFlow()" class="p-1.5 border border-gray-200 rounded-md text-xs bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-0 transition-colors">
                                                <option value="keep">Keep lines containing</option>
                                                <option value="remove">Remove lines containing</option>
                                            </select>
                                            <label class="flex items-center gap-1.5 text-xs text-gray-600 cursor-pointer select-none px-2 hover:bg-gray-50 rounded-md">
                                                <input type="checkbox" x-model="block.params.regex" @change="processFlow()" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"> Regex
                                            </label>
                                        </div>
                                        <input type="text" x-model="block.params.text" @input="processFlow()" class="w-full p-2 border border-gray-200 rounded-md text-xs font-mono focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all" placeholder="Text or pattern to match...">
                                    </div>
                                </template>

                                <!-- Replace Block -->
                                <template x-if="block.type === 'replace'">
                                    <div class="flex flex-col gap-2">
                                        <div class="flex gap-2 items-center">
                                            <input type="text" x-model="block.params.find" @input="processFlow()" class="flex-1 p-2 border border-gray-200 rounded-md text-xs font-mono focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all" placeholder="Find...">
                                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                            <input type="text" x-model="block.params.replace" @input="processFlow()" class="flex-1 p-2 border border-gray-200 rounded-md text-xs font-mono focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all" placeholder="Replace with...">
                                        </div>
                                        <label class="flex items-center gap-1.5 text-xs text-gray-600 cursor-pointer select-none w-fit px-2 hover:bg-gray-50 rounded-md">
                                            <input type="checkbox" x-model="block.params.regex" @change="processFlow()" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"> Regex Mode
                                        </label>
                                    </div>
                                </template>

                                <!-- Modify Block -->
                                <template x-if="block.type === 'modify'">
                                    <div class="flex flex-col gap-2">
                                        <select x-model="block.params.action" @change="processFlow()" class="w-full p-2 border border-gray-200 rounded-md text-xs bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-0 transition-colors">
                                            <option value="prefix">Add Prefix</option>
                                            <option value="suffix">Add Suffix</option>
                                            <option value="trim">Trim Whitespace</option>
                                            <option value="number">Add Line Numbers</option>
                                        </select>
                                        <template x-if="['prefix', 'suffix'].includes(block.params.action)">
                                            <input type="text" x-model="block.params.text" @input="processFlow()" class="w-full p-2 border border-gray-200 rounded-md text-xs font-mono focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all" placeholder="Text to add...">
                                        </template>
                                    </div>
                                </template>

                                <!-- Remove Block -->
                                <template x-if="block.type === 'remove'">
                                    <div class="flex flex-col gap-2">
                                        <select x-model="block.params.action" @change="processFlow()" class="w-full p-2 border border-gray-200 rounded-md text-xs bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-0 transition-colors">
                                            <option value="empty">Remove Empty Lines</option>
                                            <option value="duplicates">Remove Duplicate Lines</option>
                                            <option value="extra_spaces">Remove Extra Spaces</option>
                                        </select>
                                    </div>
                                </template>

                                <!-- Sort Block -->
                                <template x-if="block.type === 'sort'">
                                    <select x-model="block.params.order" @change="processFlow()" class="w-full p-2 border border-gray-200 rounded-md text-xs bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-0 transition-colors">
                                        <option value="asc">A-Z (Ascending)</option>
                                        <option value="desc">Z-A (Descending)</option>
                                        <option value="length_asc">Length (Shortest first)</option>
                                        <option value="length_desc">Length (Longest first)</option>
                                        <option value="random">Random Shuffle</option>
                                        <option value="reverse">Reverse Order</option>
                                    </select>
                                </template>

                                <!-- Case Block -->
                                <template x-if="block.type === 'case'">
                                    <select x-model="block.params.style" @change="processFlow()" class="w-full p-2 border border-gray-200 rounded-md text-xs bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-0 transition-colors">
                                        <option value="upper">UPPERCASE</option>
                                        <option value="lower">lowercase</option>
                                        <option value="title">Title Case</option>
                                        <option value="sentence">Sentence case</option>
                                        <option value="camel">camelCase</option>
                                        <option value="snake">snake_case</option>
                                        <option value="kebab">kebab-case</option>
                                    </select>
                                </template>

                                <!-- Extract Block -->
                                <template x-if="block.type === 'extract'">
                                    <select x-model="block.params.type" @change="processFlow()" class="w-full p-2 border border-gray-200 rounded-md text-xs bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-0 transition-colors">
                                        <option value="email">Emails</option>
                                        <option value="url">URLs</option>
                                        <option value="number">Numbers</option>
                                        <option value="hashtag">Hashtags</option>
                                        <option value="ip">IP Addresses</option>
                                    </select>
                                </template>

                                <!-- Custom JS Block -->
                                <template x-if="block.type === 'custom'">
                                    <div class="flex flex-col gap-2">
                                        <div class="flex justify-between items-center text-xs text-gray-500">
                                            <span>Available: <code>text</code>, <code>lines</code></span>
                                            <div class="flex items-center gap-2">
                                                <select @change="loadPreset(block, $event.target.value); $event.target.value=''" class="py-0.5 px-2 border border-gray-200 rounded text-[10px] bg-white hover:border-indigo-300 transition-colors cursor-pointer">
                                                    <option value="">Load Preset...</option>
                                                    <option value="reverse">Reverse Text</option>
                                                    <option value="length">Line Length</option>
                                                    <option value="csv_json">CSV to JSON</option>
                                                    <option value="shuffle_chars">Shuffle Chars</option>
                                                </select>
                                                <span class="text-indigo-600 font-medium bg-indigo-50 px-1.5 py-0.5 rounded">JS</span>
                                            </div>
                                        </div>
                                        <div class="relative rounded-lg overflow-hidden border border-gray-800 shadow-sm group-hover:border-indigo-500/50 transition-colors">
                                            <textarea 
                                                x-model="block.params.code" 
                                                @input="processFlow()" 
                                                class="w-full p-3 text-xs font-mono bg-[#1e1e1e] text-[#d4d4d4] focus:outline-none h-32 leading-relaxed resize-none" 
                                                spellcheck="false"
                                                placeholder="// Example: return lines.map(l => l + '!');"></textarea>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                        
                        <!-- Connector Arrow -->
                        <div x-show="index < blocks.length - 1" class="flex justify-center py-1">
                            <div class="w-0.5 h-4 bg-gray-200"></div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Available Blocks Toolbar -->
            <div class="absolute bottom-4 left-4 right-4 bg-white/90 backdrop-blur-sm border border-gray-200/80 rounded-xl p-2 flex gap-2 overflow-x-auto shadow-[0_8px_30px_rgba(0,0,0,0.12)] z-30 scrollbar-hide">
                <button @click="addBlock('filter')" class="px-3 py-2 bg-white hover:bg-gray-50 border border-gray-200 hover:border-indigo-200 rounded-lg text-xs font-medium text-gray-700 whitespace-nowrap transition-all shadow-sm hover:shadow active:scale-95 flex items-center gap-1.5">
                    <span class="text-indigo-500">🔍</span> Filter
                </button>
                <button @click="addBlock('replace')" class="px-3 py-2 bg-white hover:bg-gray-50 border border-gray-200 hover:border-indigo-200 rounded-lg text-xs font-medium text-gray-700 whitespace-nowrap transition-all shadow-sm hover:shadow active:scale-95 flex items-center gap-1.5">
                    <span class="text-indigo-500">🔄</span> Replace
                </button>
                <button @click="addBlock('modify')" class="px-3 py-2 bg-white hover:bg-gray-50 border border-gray-200 hover:border-indigo-200 rounded-lg text-xs font-medium text-gray-700 whitespace-nowrap transition-all shadow-sm hover:shadow active:scale-95 flex items-center gap-1.5">
                    <span class="text-indigo-500">✏️</span> Modify
                </button>
                <button @click="addBlock('remove')" class="px-3 py-2 bg-white hover:bg-gray-50 border border-gray-200 hover:border-indigo-200 rounded-lg text-xs font-medium text-gray-700 whitespace-nowrap transition-all shadow-sm hover:shadow active:scale-95 flex items-center gap-1.5">
                    <span class="text-indigo-500">🗑️</span> Remove
                </button>
                <button @click="addBlock('sort')" class="px-3 py-2 bg-white hover:bg-gray-50 border border-gray-200 hover:border-indigo-200 rounded-lg text-xs font-medium text-gray-700 whitespace-nowrap transition-all shadow-sm hover:shadow active:scale-95 flex items-center gap-1.5">
                    <span class="text-indigo-500">🔃</span> Sort
                </button>
                <button @click="addBlock('case')" class="px-3 py-2 bg-white hover:bg-gray-50 border border-gray-200 hover:border-indigo-200 rounded-lg text-xs font-medium text-gray-700 whitespace-nowrap transition-all shadow-sm hover:shadow active:scale-95 flex items-center gap-1.5">
                    <span class="text-indigo-500">Aa</span> Case
                </button>
                <button @click="addBlock('extract')" class="px-3 py-2 bg-white hover:bg-gray-50 border border-gray-200 hover:border-indigo-200 rounded-lg text-xs font-medium text-gray-700 whitespace-nowrap transition-all shadow-sm hover:shadow active:scale-95 flex items-center gap-1.5">
                    <span class="text-indigo-500">⚡</span> Extract
                </button>
                <div class="w-px h-8 bg-gray-200 mx-1"></div>
                <button @click="addBlock('custom')" class="px-3 py-2 bg-indigo-50 hover:bg-indigo-100 border border-indigo-200 hover:border-indigo-300 rounded-lg text-xs font-medium text-indigo-700 whitespace-nowrap transition-all shadow-sm hover:shadow active:scale-95 flex items-center gap-1.5">
                    <span class="text-indigo-600">💻</span> Custom JS
                </button>
            </div>
        </div>

        <!-- Right Pane: Output -->
        <div class="w-full lg:w-1/4 flex flex-col border-l border-gray-200 bg-white h-full" :class="{'hidden lg:flex': activeTab !== 'output'}">
            <div class="flex justify-between items-center p-3 border-b border-gray-100 bg-gray-50">
                <label class="text-xs font-bold text-gray-700 uppercase tracking-wider">Result</label>
                <div class="flex gap-2">
                    <span class="text-xs text-gray-500" x-text="outputStats"></span>
                    <button @click="copyOutput()" class="text-xs text-indigo-600 hover:text-indigo-700 font-medium bg-indigo-50 px-2 py-1 rounded hover:bg-indigo-100 transition-colors">Copy</button>
                </div>
            </div>
            <textarea 
                x-model="outputText" 
                readonly
                class="flex-1 w-full p-4 text-sm border-0 focus:ring-0 bg-gray-50/50 resize-none font-mono text-gray-800" 
                placeholder="Result will appear here..."></textarea>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('textFlowStudio', () => ({
            activeTab: 'flow',
            inputText: '',
            outputText: '',
            commandQuery: '',
            blocks: [],
            draggingIndex: null,
            dragOverIndex: null,
            
            init() {
                const saved = localStorage.getItem('textFlowState');
                if (saved) {
                    try {
                        const state = JSON.parse(saved);
                        this.inputText = state.inputText || '';
                        this.blocks = state.blocks || [];
                        this.processFlow();
                    } catch (e) {}
                }
                
                this.$watch('inputText', () => this.saveState());
                this.$watch('blocks', () => this.saveState());
            },

            saveState() {
                localStorage.setItem('textFlowState', JSON.stringify({
                    inputText: this.inputText,
                    blocks: this.blocks
                }));
            },

            get inputStats() {
                return `${this.inputText.length} chars, ${this.inputText.split('\n').length} lines`;
            },

            get outputStats() {
                return `${this.outputText.length} chars, ${this.outputText.split('\n').length} lines`;
            },

            dragStart(index) {
                this.draggingIndex = index;
            },

            dragEnter(index) {
                if (index !== this.draggingIndex) {
                    this.dragOverIndex = index;
                }
            },

            dragEnd() {
                if (this.draggingIndex !== null && this.dragOverIndex !== null) {
                    // Reorder blocks
                    const item = this.blocks.splice(this.draggingIndex, 1)[0];
                    this.blocks.splice(this.dragOverIndex, 0, item);
                    this.processFlow();
                }
                this.draggingIndex = null;
                this.dragOverIndex = null;
            },

            handleDrop(e) {
                // Just in case
                this.dragEnd();
            },

            addBlock(type, params = {}) {
                const defaults = {
                    filter: { mode: 'keep', text: '', regex: false },
                    replace: { find: '', replace: '', regex: false },
                    modify: { action: 'trim', text: '' },
                    remove: { action: 'empty' },
                    sort: { order: 'asc' },
                    case: { style: 'upper' },
                    extract: { type: 'email' },
                    custom: { code: 'return lines;' }
                };

                const names = {
                    filter: 'Filter Lines',
                    replace: 'Find & Replace',
                    modify: 'Modify Text',
                    remove: 'Remove Lines',
                    sort: 'Sort Lines',
                    case: 'Change Case',
                    extract: 'Extract Data',
                    custom: 'Custom JavaScript'
                };

                this.blocks.push({
                    id: Date.now() + Math.random(),
                    type: type,
                    name: names[type],
                    params: { ...defaults[type], ...params }
                });

                this.processFlow();
                
                if (window.innerWidth < 1024) {
                    this.activeTab = 'flow';
                }
                
                // Scroll to bottom
                this.$nextTick(() => {
                    const container = this.$el.querySelector('.custom-scrollbar');
                    if (container) container.scrollTop = container.scrollHeight;
                });
            },

            removeBlock(index) {
                this.blocks.splice(index, 1);
                this.processFlow();
            },

            loadPreset(block, preset) {
                if (!preset) return;
                
                const presets = {
                    reverse: "return text.split('').reverse().join('');",
                    length: "return lines.map(l => l + ' (' + l.length + ')');",
                    csv_json: "const headers = lines[0].split(',');\nreturn JSON.stringify(lines.slice(1).map(line => {\n  const values = line.split(',');\n  return headers.reduce((obj, header, i) => {\n    obj[header] = values[i];\n    return obj;\n  }, {});\n}), null, 2);",
                    shuffle_chars: "return lines.map(l => l.split('').sort(() => Math.random() - 0.5).join(''));"
                };
                
                if (presets[preset]) {
                    block.params.code = presets[preset];
                    this.processFlow();
                }
            },

            parseCommand() {
                const cmd = this.commandQuery.toLowerCase();
                
                if (cmd.includes('email')) this.addBlock('extract', { type: 'email' });
                if (cmd.includes('url') || cmd.includes('link')) this.addBlock('extract', { type: 'url' });
                if (cmd.includes('ip')) this.addBlock('extract', { type: 'ip' });
                
                if (cmd.includes('sort')) {
                    if (cmd.includes('desc') || cmd.includes('reverse')) this.addBlock('sort', { order: 'desc' });
                    else if (cmd.includes('random') || cmd.includes('shuffle')) this.addBlock('sort', { order: 'random' });
                    else this.addBlock('sort', { order: 'asc' });
                }
                
                if (cmd.includes('upper')) this.addBlock('case', { style: 'upper' });
                if (cmd.includes('lower')) this.addBlock('case', { style: 'lower' });
                if (cmd.includes('title')) this.addBlock('case', { style: 'title' });
                
                if (cmd.includes('trim')) this.addBlock('modify', { action: 'trim' });
                if (cmd.includes('empty')) this.addBlock('remove', { action: 'empty' });
                if (cmd.includes('duplicate')) this.addBlock('remove', { action: 'duplicates' });

                if (cmd.includes('filter') || cmd.includes('remove') || cmd.includes('keep')) {
                    // Only add filter if it wasn't one of the specific remove commands above
                    if (!cmd.includes('empty') && !cmd.includes('duplicate')) {
                        const mode = cmd.includes('remove') ? 'remove' : 'keep';
                        const match = cmd.match(/['"]([^'"]+)['"]/);
                        const text = match ? match[1] : '';
                        this.addBlock('filter', { mode: mode, text: text });
                    }
                }
                
                this.commandQuery = '';
            },

            processFlow() {
                let currentText = this.inputText;
                let lines = currentText.split('\n');

                try {
                    this.blocks.forEach(block => {
                        switch (block.type) {
                            case 'filter':
                                if (block.params.text) {
                                    let predicate;
                                    if (block.params.regex) {
                                        try {
                                            const regex = new RegExp(block.params.text, 'i');
                                            predicate = l => regex.test(l);
                                        } catch (e) { predicate = () => false; }
                                    } else {
                                        const search = block.params.text.toLowerCase();
                                        predicate = l => l.toLowerCase().includes(search);
                                    }
                                    
                                    if (block.params.mode === 'keep') {
                                        lines = lines.filter(predicate);
                                    } else {
                                        lines = lines.filter(l => !predicate(l));
                                    }
                                }
                                break;
                                
                            case 'replace':
                                if (block.params.find) {
                                    if (block.params.regex) {
                                        try {
                                            const regex = new RegExp(block.params.find, 'g');
                                            lines = lines.map(l => l.replace(regex, block.params.replace));
                                        } catch (e) {}
                                    } else {
                                        lines = lines.map(l => l.replaceAll(block.params.find, block.params.replace));
                                    }
                                }
                                break;

                            case 'modify':
                                if (block.params.action === 'trim') lines = lines.map(l => l.trim());
                                if (block.params.action === 'prefix') lines = lines.map(l => block.params.text + l);
                                if (block.params.action === 'suffix') lines = lines.map(l => l + block.params.text);
                                if (block.params.action === 'number') lines = lines.map((l, i) => `${i + 1}. ${l}`);
                                break;

                            case 'remove':
                                if (block.params.action === 'empty') lines = lines.filter(l => l.trim().length > 0);
                                if (block.params.action === 'duplicates') lines = [...new Set(lines)];
                                if (block.params.action === 'extra_spaces') lines = lines.map(l => l.replace(/\s+/g, ' ').trim());
                                break;
                                
                            case 'sort':
                                if (block.params.order === 'asc') lines.sort();
                                else if (block.params.order === 'desc') lines.sort().reverse();
                                else if (block.params.order === 'length_asc') lines.sort((a, b) => a.length - b.length);
                                else if (block.params.order === 'length_desc') lines.sort((a, b) => b.length - a.length);
                                else if (block.params.order === 'random') lines.sort(() => Math.random() - 0.5);
                                else if (block.params.order === 'reverse') lines.reverse();
                                break;
                                
                            case 'case':
                                lines = lines.map(l => {
                                    if (block.params.style === 'upper') return l.toUpperCase();
                                    if (block.params.style === 'lower') return l.toLowerCase();
                                    if (block.params.style === 'title') return l.replace(/\w\S*/g, w => w.charAt(0).toUpperCase() + w.substr(1).toLowerCase());
                                    if (block.params.style === 'sentence') return l.charAt(0).toUpperCase() + l.slice(1).toLowerCase();
                                    if (block.params.style === 'camel') return l.replace(/(?:^\w|[A-Z]|\b\w)/g, (w, i) => i === 0 ? w.toLowerCase() : w.toUpperCase()).replace(/\s+/g, '');
                                    if (block.params.style === 'snake') return l.match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g).map(x => x.toLowerCase()).join('_');
                                    if (block.params.style === 'kebab') return l.match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g).map(x => x.toLowerCase()).join('-');
                                    return l;
                                });
                                break;
                                
                            case 'extract':
                                const text = lines.join('\n');
                                let matches = [];
                                if (block.params.type === 'email') matches = text.match(/[\w.-]+@[\w.-]+\.\w+/g) || [];
                                else if (block.params.type === 'url') matches = text.match(/https?:\/\/[^\s]+/g) || [];
                                else if (block.params.type === 'number') matches = text.match(/\d+/g) || [];
                                else if (block.params.type === 'hashtag') matches = text.match(/#\w+/g) || [];
                                else if (block.params.type === 'ip') matches = text.match(/\b\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\b/g) || [];
                                lines = matches;
                                break;

                            case 'custom':
                                try {
                                    const func = new Function('text', 'lines', block.params.code);
                                    const result = func(lines.join('\n'), lines);
                                    if (Array.isArray(result)) lines = result;
                                    else if (typeof result === 'string') lines = result.split('\n');
                                } catch (e) {
                                    console.error('Custom JS Error', e);
                                }
                                break;
                        }
                    });
                } catch (e) {
                    console.error('Pipeline Error', e);
                }

                this.outputText = lines.join('\n');
            },

            copyOutput() {
                navigator.clipboard.writeText(this.outputText);
            }
        }));
    });
</script>
@endpush

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('textFlowStudio', () => ({
            activeTab: 'flow',
            inputText: '',
            outputText: '',
            commandQuery: '',
            blocks: [],
            draggingIndex: null,
            dragOverIndex: null,
            
            init() {
                const saved = localStorage.getItem('textFlowState');
                if (saved) {
                    try {
                        const state = JSON.parse(saved);
                        this.inputText = state.inputText || '';
                        this.blocks = state.blocks || [];
                        this.processFlow();
                    } catch (e) {}
                }
                
                this.$watch('inputText', () => this.saveState());
                this.$watch('blocks', () => this.saveState());
            },

            saveState() {
                localStorage.setItem('textFlowState', JSON.stringify({
                    inputText: this.inputText,
                    blocks: this.blocks
                }));
            },

            get inputStats() {
                return `${this.inputText.length} chars, ${this.inputText.split('\n').length} lines`;
            },

            get outputStats() {
                return `${this.outputText.length} chars, ${this.outputText.split('\n').length} lines`;
            },

            dragStart(index) {
                this.draggingIndex = index;
            },

            dragEnter(index) {
                if (index !== this.draggingIndex) {
                    this.dragOverIndex = index;
                }
            },

            dragEnd() {
                if (this.draggingIndex !== null && this.dragOverIndex !== null) {
                    // Reorder blocks
                    const item = this.blocks.splice(this.draggingIndex, 1)[0];
                    this.blocks.splice(this.dragOverIndex, 0, item);
                    this.processFlow();
                }
                this.draggingIndex = null;
                this.dragOverIndex = null;
            },

            handleDrop(e) {
                // Just in case
                this.dragEnd();
            },

            addBlock(type, params = {}) {
                const defaults = {
                    filter: { mode: 'keep', text: '', regex: false },
                    replace: { find: '', replace: '', regex: false },
                    modify: { action: 'trim', text: '' },
                    remove: { action: 'empty' },
                    sort: { order: 'asc' },
                    case: { style: 'upper' },
                    extract: { type: 'email' },
                    custom: { code: 'return lines;' }
                };

                const names = {
                    filter: 'Filter Lines',
                    replace: 'Find & Replace',
                    modify: 'Modify Text',
                    remove: 'Remove Lines',
                    sort: 'Sort Lines',
                    case: 'Change Case',
                    extract: 'Extract Data',
                    custom: 'Custom JavaScript'
                };

                this.blocks.push({
                    id: Date.now() + Math.random(),
                    type: type,
                    name: names[type],
                    params: { ...defaults[type], ...params }
                });

                this.processFlow();
                
                if (window.innerWidth < 1024) {
                    this.activeTab = 'flow';
                }
            },

            removeBlock(index) {
                this.blocks.splice(index, 1);
                this.processFlow();
            },

            loadPreset(block, preset) {
                if (!preset) return;
                
                const presets = {
                    reverse: "return text.split('').reverse().join('');",
                    length: "return lines.map(l => l + ' (' + l.length + ')');",
                    csv_json: "const headers = lines[0].split(',');\nreturn JSON.stringify(lines.slice(1).map(line => {\n  const values = line.split(',');\n  return headers.reduce((obj, header, i) => {\n    obj[header] = values[i];\n    return obj;\n  }, {});\n}), null, 2);",
                    shuffle_chars: "return lines.map(l => l.split('').sort(() => Math.random() - 0.5).join(''));"
                };
                
                if (presets[preset]) {
                    block.params.code = presets[preset];
                    this.processFlow();
                }
            },

            parseCommand() {
                const cmd = this.commandQuery.toLowerCase();
                
                if (cmd.includes('email')) this.addBlock('extract', { type: 'email' });
                if (cmd.includes('url') || cmd.includes('link')) this.addBlock('extract', { type: 'url' });
                if (cmd.includes('ip')) this.addBlock('extract', { type: 'ip' });
                
                if (cmd.includes('sort')) {
                    if (cmd.includes('desc') || cmd.includes('reverse')) this.addBlock('sort', { order: 'desc' });
                    else if (cmd.includes('random') || cmd.includes('shuffle')) this.addBlock('sort', { order: 'random' });
                    else this.addBlock('sort', { order: 'asc' });
                }
                
                if (cmd.includes('upper')) this.addBlock('case', { style: 'upper' });
                if (cmd.includes('lower')) this.addBlock('case', { style: 'lower' });
                if (cmd.includes('title')) this.addBlock('case', { style: 'title' });
                
                if (cmd.includes('trim')) this.addBlock('modify', { action: 'trim' });
                if (cmd.includes('empty')) this.addBlock('remove', { action: 'empty' });
                if (cmd.includes('duplicate')) this.addBlock('remove', { action: 'duplicates' });

                if (cmd.includes('filter') || cmd.includes('remove') || cmd.includes('keep')) {
                    // Only add filter if it wasn't one of the specific remove commands above
                    if (!cmd.includes('empty') && !cmd.includes('duplicate')) {
                        const mode = cmd.includes('remove') ? 'remove' : 'keep';
                        const match = cmd.match(/['"]([^'"]+)['"]/);
                        const text = match ? match[1] : '';
                        this.addBlock('filter', { mode: mode, text: text });
                    }
                }
                
                this.commandQuery = '';
            },

            processFlow() {
                let currentText = this.inputText;
                let lines = currentText.split('\n');

                try {
                    this.blocks.forEach(block => {
                        switch (block.type) {
                            case 'filter':
                                if (block.params.text) {
                                    let predicate;
                                    if (block.params.regex) {
                                        try {
                                            const regex = new RegExp(block.params.text, 'i');
                                            predicate = l => regex.test(l);
                                        } catch (e) { predicate = () => false; }
                                    } else {
                                        const search = block.params.text.toLowerCase();
                                        predicate = l => l.toLowerCase().includes(search);
                                    }
                                    
                                    if (block.params.mode === 'keep') {
                                        lines = lines.filter(predicate);
                                    } else {
                                        lines = lines.filter(l => !predicate(l));
                                    }
                                }
                                break;
                                
                            case 'replace':
                                if (block.params.find) {
                                    if (block.params.regex) {
                                        try {
                                            const regex = new RegExp(block.params.find, 'g');
                                            lines = lines.map(l => l.replace(regex, block.params.replace));
                                        } catch (e) {}
                                    } else {
                                        lines = lines.map(l => l.replaceAll(block.params.find, block.params.replace));
                                    }
                                }
                                break;

                            case 'modify':
                                if (block.params.action === 'trim') lines = lines.map(l => l.trim());
                                if (block.params.action === 'prefix') lines = lines.map(l => block.params.text + l);
                                if (block.params.action === 'suffix') lines = lines.map(l => l + block.params.text);
                                if (block.params.action === 'number') lines = lines.map((l, i) => `${i + 1}. ${l}`);
                                break;

                            case 'remove':
                                if (block.params.action === 'empty') lines = lines.filter(l => l.trim().length > 0);
                                if (block.params.action === 'duplicates') lines = [...new Set(lines)];
                                if (block.params.action === 'extra_spaces') lines = lines.map(l => l.replace(/\s+/g, ' ').trim());
                                break;
                                
                            case 'sort':
                                if (block.params.order === 'asc') lines.sort();
                                else if (block.params.order === 'desc') lines.sort().reverse();
                                else if (block.params.order === 'length_asc') lines.sort((a, b) => a.length - b.length);
                                else if (block.params.order === 'length_desc') lines.sort((a, b) => b.length - a.length);
                                else if (block.params.order === 'random') lines.sort(() => Math.random() - 0.5);
                                else if (block.params.order === 'reverse') lines.reverse();
                                break;
                                
                            case 'case':
                                lines = lines.map(l => {
                                    if (block.params.style === 'upper') return l.toUpperCase();
                                    if (block.params.style === 'lower') return l.toLowerCase();
                                    if (block.params.style === 'title') return l.replace(/\w\S*/g, w => w.charAt(0).toUpperCase() + w.substr(1).toLowerCase());
                                    if (block.params.style === 'sentence') return l.charAt(0).toUpperCase() + l.slice(1).toLowerCase();
                                    if (block.params.style === 'camel') return l.replace(/(?:^\w|[A-Z]|\b\w)/g, (w, i) => i === 0 ? w.toLowerCase() : w.toUpperCase()).replace(/\s+/g, '');
                                    if (block.params.style === 'snake') return l.match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g).map(x => x.toLowerCase()).join('_');
                                    if (block.params.style === 'kebab') return l.match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g).map(x => x.toLowerCase()).join('-');
                                    return l;
                                });
                                break;
                                
                            case 'extract':
                                const text = lines.join('\n');
                                let matches = [];
                                if (block.params.type === 'email') matches = text.match(/[\w.-]+@[\w.-]+\.\w+/g) || [];
                                else if (block.params.type === 'url') matches = text.match(/https?:\/\/[^\s]+/g) || [];
                                else if (block.params.type === 'number') matches = text.match(/\d+/g) || [];
                                else if (block.params.type === 'hashtag') matches = text.match(/#\w+/g) || [];
                                else if (block.params.type === 'ip') matches = text.match(/\b\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\b/g) || [];
                                lines = matches;
                                break;

                            case 'custom':
                                try {
                                    const func = new Function('text', 'lines', block.params.code);
                                    const result = func(lines.join('\n'), lines);
                                    if (Array.isArray(result)) lines = result;
                                    else if (typeof result === 'string') lines = result.split('\n');
                                } catch (e) {
                                    console.error('Custom JS Error', e);
                                }
                                break;
                        }
                    });
                } catch (e) {
                    console.error('Pipeline Error', e);
                }

                this.outputText = lines.join('\n');
            },

            copyOutput() {
                navigator.clipboard.writeText(this.outputText);
            }
        }));
    });
</script>
@endpush

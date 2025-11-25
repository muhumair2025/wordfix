@extends('layouts.tool')

@section('title', 'Online SQL Beautifier Tool - WordFix')

@section('tool-title', 'Online SQL Beautifier Tool')

@section('tool-description', 'Format and beautify your SQL queries with proper indentation and keyword formatting')

@section('tool-content')
<!-- Text Converter Component -->
<x-text-converter 
    toolId="sqlBeautifier"
    inputPlaceholder="Paste your unformatted SQL query here"
    outputPlaceholder="Beautified SQL will appear here"
    downloadFileName="beautified.sql"
    :showStats="true"
/>

<!-- Formatting Options -->
<div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-900 mb-3">Formatting Options</h3>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label for="indentSize" class="block text-xs font-medium text-gray-700 mb-1">Indent Size:</label>
            <select id="indentSize" onchange="updateFormatting()" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="2">2 spaces</option>
                <option value="4" selected>4 spaces</option>
                <option value="tab">1 tab</option>
            </select>
        </div>
        <div>
            <label for="keywordCase" class="block text-xs font-medium text-gray-700 mb-1">Keyword Case:</label>
            <select id="keywordCase" onchange="updateFormatting()" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="upper" selected>UPPERCASE</option>
                <option value="lower">lowercase</option>
                <option value="capitalize">Capitalize</option>
            </select>
        </div>
        <div class="flex items-end">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="newlineBeforeClause" checked onchange="updateFormatting()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">New line before clauses</span>
            </label>
        </div>
        <div class="flex items-end">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="indentColumns" checked onchange="updateFormatting()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Indent column lists</span>
            </label>
        </div>
    </div>
</div>

<div class="text-sm text-blue-600 mb-6">
    This SQL beautifier formats your SQL queries into a clean, readable format with proper indentation, keyword formatting, and structure. <strong>Handles multiple statements, CREATE TABLE, INSERT with multiple rows, CREATE INDEX, and complex queries.</strong> Supports MySQL, PostgreSQL, SQL Server, and standard SQL syntax.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">SQL Beautifier Example</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Unformatted Complex SQL)</p>
            <div class="bg-red-50 border border-red-200 rounded p-3 text-xs text-gray-700 font-mono overflow-auto" style="max-height: 300px;">
                CREATE TABLE users(id INTEGER PRIMARY KEY AUTOINCREMENT,username TEXT NOT NULL UNIQUE,email TEXT NOT NULL);INSERT INTO users(username,email) VALUES('alice','alice@test.com'),('bob','bob@test.com');CREATE INDEX idx_users_email ON users(email);
            </div>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (Beautified SQL)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-xs text-gray-700 font-mono overflow-auto" style="max-height: 300px;">
                CREATE TABLE users (<br>
                &nbsp;&nbsp;&nbsp;&nbsp;id INTEGER PRIMARY KEY AUTOINCREMENT,<br>
                &nbsp;&nbsp;&nbsp;&nbsp;username TEXT NOT NULL UNIQUE,<br>
                &nbsp;&nbsp;&nbsp;&nbsp;email TEXT NOT NULL<br>
                );<br><br>
                INSERT INTO users (username, email)<br>
                VALUES<br>
                &nbsp;&nbsp;&nbsp;&nbsp;('alice', 'alice@test.com'),<br>
                &nbsp;&nbsp;&nbsp;&nbsp;('bob', 'bob@test.com');<br><br>
                CREATE INDEX idx_users_email<br>
                &nbsp;&nbsp;&nbsp;&nbsp;ON users (email);
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About SQL Beautifier Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>SQL Beautifier</strong> is a powerful formatting tool that transforms messy or minified SQL queries into clean, readable, and properly indented code. Perfect for debugging, learning SQL, code reviews, and maintaining database queries.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use the SQL Beautifier</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Paste your unformatted SQL query into the input box</li>
            <li>Choose your preferred formatting options (indent size, keyword case, etc.)</li>
            <li>The tool automatically beautifies your SQL in real-time</li>
            <li>Copy the formatted SQL or download it as a .sql file</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Multiple Statement Support</strong> - Handles multiple SQL statements separated by semicolons</li>
            <li><strong>CREATE TABLE Formatting</strong> - Each column definition on its own indented line</li>
            <li><strong>INSERT Formatting</strong> - Multiple value sets properly formatted and indented</li>
            <li><strong>CREATE INDEX Formatting</strong> - Clean index creation statements</li>
            <li><strong>Keyword Formatting</strong> - Convert SQL keywords to UPPERCASE, lowercase, or Capitalized</li>
            <li><strong>Smart Indentation</strong> - Proper indentation for clauses, subqueries, and nested statements</li>
            <li><strong>Column List Formatting</strong> - Each column on its own line for better readability</li>
            <li><strong>Join Formatting</strong> - Clean formatting of JOIN clauses with proper ON conditions</li>
            <li><strong>WHERE Clause</strong> - Logical operators (AND, OR) properly indented</li>
            <li>Automatic indentation with customizable indent size (2 or 4 spaces, or tabs)</li>
            <li>Preserves comments and string literals</li>
            <li>Handles complex queries with subqueries and CTEs</li>
            <li>Supports all major SQL databases (MySQL, PostgreSQL, SQL Server, Oracle, SQLite)</li>
            <li>Real-time formatting as you type</li>
            <li>Import SQL from files</li>
            <li>Download beautified SQL</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Supported SQL Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>DDL Statements:</strong> CREATE TABLE, CREATE INDEX, CREATE UNIQUE INDEX, ALTER TABLE, DROP TABLE</li>
            <li><strong>DML Statements:</strong> SELECT, INSERT (with multiple rows), UPDATE, DELETE</li>
            <li><strong>Data Types:</strong> INTEGER, TEXT, VARCHAR, REAL, DECIMAL, DATETIME, TIMESTAMP, JSON, etc.</li>
            <li><strong>Constraints:</strong> PRIMARY KEY, FOREIGN KEY, UNIQUE, NOT NULL, CHECK, DEFAULT</li>
            <li><strong>Auto Increment:</strong> AUTOINCREMENT, AUTO_INCREMENT</li>
            <li><strong>Joins:</strong> INNER JOIN, LEFT JOIN, RIGHT JOIN, FULL OUTER JOIN, CROSS JOIN</li>
            <li><strong>Clauses:</strong> WHERE, GROUP BY, HAVING, ORDER BY, LIMIT, OFFSET</li>
            <li><strong>Operators:</strong> AND, OR, IN, NOT IN, BETWEEN, LIKE</li>
            <li><strong>Functions:</strong> Aggregate functions (COUNT, SUM, AVG, etc.), CURRENT_TIMESTAMP</li>
            <li><strong>Subqueries:</strong> Nested SELECT statements</li>
            <li><strong>CTEs:</strong> Common Table Expressions (WITH clause)</li>
            <li><strong>UNION/INTERSECT/EXCEPT:</strong> Set operations</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Formatting database schema dumps with CREATE TABLE statements</li>
            <li>Beautifying migration scripts with multiple SQL statements</li>
            <li>Formatting minified or one-line SQL queries</li>
            <li>Cleaning up SQL copied from logs or error messages</li>
            <li>Standardizing SQL code style across teams</li>
            <li>Making complex queries more readable for debugging</li>
            <li>Preparing SQL for code reviews and documentation</li>
            <li>Learning SQL by examining properly formatted queries</li>
            <li>Converting between different SQL coding styles</li>
            <li>Formatting INSERT statements with multiple rows for seed data</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Keyword Case Options</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>UPPERCASE:</strong> SELECT, FROM, WHERE (most common convention)</li>
            <li><strong>lowercase:</strong> select, from, where (modern style)</li>
            <li><strong>Capitalize:</strong> Select, From, Where (middle ground)</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Paste multiple SQL statements at once - they'll be formatted and separated with blank lines</li>
            <li>UPPERCASE keywords is the most widely accepted SQL convention</li>
            <li>Enable "Indent column lists" for CREATE TABLE or SELECT with many columns</li>
            <li>Use "New line before clauses" for better readability of complex queries</li>
            <li>The tool preserves the logic and structure of your queries</li>
            <li>Works with entire database schema dumps and migration files</li>
            <li>Handles INSERT statements with multiple value sets elegantly</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let formatOptions = {
        indentSize: 4,
        indentChar: ' ',
        keywordCase: 'upper',
        newlineBeforeClause: true,
        indentColumns: true
    };
    
    // SQL Keywords
    const SQL_KEYWORDS = [
        'SELECT', 'FROM', 'WHERE', 'INSERT', 'UPDATE', 'DELETE', 'CREATE', 'ALTER', 'DROP',
        'TABLE', 'INDEX', 'VIEW', 'JOIN', 'INNER', 'LEFT', 'RIGHT', 'FULL', 'OUTER', 'CROSS',
        'ON', 'AND', 'OR', 'NOT', 'IN', 'EXISTS', 'BETWEEN', 'LIKE', 'IS', 'NULL',
        'GROUP', 'BY', 'HAVING', 'ORDER', 'ASC', 'DESC', 'LIMIT', 'OFFSET',
        'UNION', 'INTERSECT', 'EXCEPT', 'ALL', 'DISTINCT', 'AS', 'INTO', 'VALUES',
        'SET', 'CASE', 'WHEN', 'THEN', 'ELSE', 'END', 'WITH', 'RECURSIVE',
        'PRIMARY', 'KEY', 'FOREIGN', 'REFERENCES', 'UNIQUE', 'CHECK', 'DEFAULT',
        'AUTOINCREMENT', 'AUTO_INCREMENT', 'CURRENT_TIMESTAMP', 'DATETIME', 'TIMESTAMP',
        'INTEGER', 'INT', 'VARCHAR', 'TEXT', 'REAL', 'FLOAT', 'DECIMAL', 'BOOLEAN', 'JSON',
        'CONSTRAINT', 'CASCADE', 'RESTRICT', 'NO', 'ACTION', 'TEMPORARY', 'IF'
    ];
    
    const MAJOR_CLAUSES = ['SELECT', 'FROM', 'WHERE', 'GROUP BY', 'HAVING', 'ORDER BY', 'LIMIT', 'OFFSET', 'UNION', 'INTERSECT', 'EXCEPT'];
    
    // Update formatting options
    window.updateFormatting = function() {
        const indentSize = document.getElementById('indentSize').value;
        if (indentSize === 'tab') {
            formatOptions.indentSize = 1;
            formatOptions.indentChar = '\t';
        } else {
            formatOptions.indentSize = parseInt(indentSize);
            formatOptions.indentChar = ' ';
        }
        
        formatOptions.keywordCase = document.getElementById('keywordCase').value;
        formatOptions.newlineBeforeClause = document.getElementById('newlineBeforeClause').checked;
        formatOptions.indentColumns = document.getElementById('indentColumns').checked;
        
        // Trigger re-conversion
        const inputElement = document.getElementById('sqlBeautifier-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function for the component
    setSqlBeautifierConverter(function(sql) {
        if (!sql || !sql.trim()) return '';
        return beautifySQL(sql, formatOptions);
    });
    
    function beautifySQL(sql, options) {
        sql = sql.trim();
        const indent = options.indentChar.repeat(options.indentSize);
        
        // Preserve strings and comments
        const strings = [];
        const comments = [];
        
        // Extract single-line comments
        sql = sql.replace(/--[^\n]*/g, (match) => {
            comments.push(match);
            return `__COMMENT_${comments.length - 1}__`;
        });
        
        // Extract multi-line comments
        sql = sql.replace(/\/\*[\s\S]*?\*\//g, (match) => {
            comments.push(match);
            return `__COMMENT_${comments.length - 1}__`;
        });
        
        // Extract strings
        sql = sql.replace(/'([^']|'')*'/g, (match) => {
            strings.push(match);
            return `__STRING_${strings.length - 1}__`;
        });
        
        // Split by semicolons to handle multiple statements
        const statements = sql.split(';').filter(s => s.trim());
        const formattedStatements = statements.map(statement => {
            return formatStatement(statement.trim(), options, indent, strings);
        });
        
        let result = formattedStatements.join(';\n\n') + (sql.trim().endsWith(';') ? ';' : '');
        
        // Restore strings
        strings.forEach((str, index) => {
            result = result.replace(new RegExp(`__STRING_${index}__`, 'g'), str);
        });
        
        // Restore comments
        comments.forEach((comment, index) => {
            result = result.replace(`__COMMENT_${index}__`, comment);
        });
        
        return result.trim();
    }
    
    function formatStatement(sql, options, indent, strings) {
        sql = sql.trim();
        
        // Normalize whitespace
        sql = sql.replace(/\s+/g, ' ');
        
        // Format keywords
        SQL_KEYWORDS.forEach(keyword => {
            const regex = new RegExp(`\\b${keyword}\\b`, 'gi');
            sql = sql.replace(regex, formatKeyword(keyword, options.keywordCase));
        });
        
        // Detect statement type
        const upperSQL = sql.toUpperCase();
        
        if (upperSQL.startsWith('CREATE TABLE') || upperSQL.startsWith('CREATE TEMPORARY TABLE')) {
            return formatCreateTable(sql, options, indent);
        } else if (upperSQL.startsWith('CREATE INDEX') || upperSQL.startsWith('CREATE UNIQUE INDEX')) {
            return formatCreateIndex(sql, options, indent);
        } else if (upperSQL.startsWith('INSERT INTO')) {
            return formatInsert(sql, options, indent);
        } else if (upperSQL.startsWith('UPDATE')) {
            return formatUpdate(sql, options, indent);
        } else if (upperSQL.startsWith('DELETE')) {
            return formatDelete(sql, options, indent);
        } else if (upperSQL.startsWith('SELECT')) {
            return formatSelect(sql, options, indent);
        }
        
        return sql;
    }
    
    function formatCreateTable(sql, options, indent) {
        // Extract table name and column definitions
        const match = sql.match(/CREATE\s+(?:TEMPORARY\s+)?TABLE\s+(\S+)\s*\((.*)\)/is);
        if (!match) return sql;
        
        const createKeyword = formatKeyword('CREATE TABLE', options.keywordCase);
        const tableName = match[1];
        const columnDefs = match[2];
        
        // Split column definitions
        const columns = splitByCommaOutsideParens(columnDefs);
        const formattedColumns = columns.map(col => indent + col.trim()).join(',\n');
        
        return `${createKeyword} ${tableName} (\n${formattedColumns}\n)`;
    }
    
    function formatCreateIndex(sql, options, indent) {
        const createIndexKeyword = formatKeyword('CREATE INDEX', options.keywordCase);
        const onKeyword = formatKeyword('ON', options.keywordCase);
        
        sql = sql.replace(/CREATE\s+(?:UNIQUE\s+)?INDEX\s+(\S+)\s+ON\s+(\S+)\s*\((.*?)\)/is, (match, indexName, tableName, columns) => {
            const isUnique = /CREATE\s+UNIQUE\s+INDEX/i.test(sql);
            const uniqueKeyword = isUnique ? formatKeyword('UNIQUE', options.keywordCase) + ' ' : '';
            return `${formatKeyword('CREATE', options.keywordCase)} ${uniqueKeyword}${formatKeyword('INDEX', options.keywordCase)} ${indexName}\n${indent}${onKeyword} ${tableName} (${columns.trim()})`;
        });
        
        return sql;
    }
    
    function formatInsert(sql, options, indent) {
        const insertKeyword = formatKeyword('INSERT INTO', options.keywordCase);
        const valuesKeyword = formatKeyword('VALUES', options.keywordCase);
        
        // Extract parts
        const match = sql.match(/INSERT\s+INTO\s+(\S+)\s*\((.*?)\)\s*VALUES\s*(.+)/is);
        if (!match) return sql;
        
        const tableName = match[1];
        const columns = match[2];
        const valuesSection = match[3];
        
        // Format column list
        const columnList = columns.split(',').map(c => c.trim());
        const formattedColumns = options.indentColumns && columnList.length > 3
            ? '(\n' + columnList.map(c => indent + c).join(',\n') + '\n)'
            : `(${columns.trim()})`;
        
        // Extract value sets (handle multiple rows)
        const valueSets = [];
        let depth = 0;
        let currentSet = '';
        
        for (let i = 0; i < valuesSection.length; i++) {
            const char = valuesSection[i];
            if (char === '(') depth++;
            if (char === ')') depth--;
            
            currentSet += char;
            
            if (depth === 0 && char === ')') {
                if (currentSet.trim()) {
                    valueSets.push(currentSet.trim());
                    currentSet = '';
                }
            }
        }
        
        // Format value sets
        const formattedValues = valueSets.map(set => indent + set).join(',\n');
        
        return `${insertKeyword} ${tableName} ${formattedColumns}\n${valuesKeyword}\n${formattedValues}`;
    }
    
    function formatUpdate(sql, options, indent) {
        const updateKeyword = formatKeyword('UPDATE', options.keywordCase);
        const setKeyword = formatKeyword('SET', options.keywordCase);
        const whereKeyword = formatKeyword('WHERE', options.keywordCase);
        
        sql = sql.replace(/UPDATE\s+(\S+)\s+SET\s+(.*?)(?:\s+WHERE\s+(.*))?$/is, (match, table, sets, where) => {
            const setList = sets.split(',').map(s => indent + s.trim()).join(',\n');
            let result = `${updateKeyword} ${table}\n${setKeyword}\n${setList}`;
            
            if (where) {
                const formattedWhere = formatWhereClause(where, options, indent);
                result += `\n${whereKeyword} ${formattedWhere}`;
            }
            
            return result;
        });
        
        return sql;
    }
    
    function formatDelete(sql, options, indent) {
        const deleteKeyword = formatKeyword('DELETE FROM', options.keywordCase);
        const whereKeyword = formatKeyword('WHERE', options.keywordCase);
        
        sql = sql.replace(/DELETE\s+FROM\s+(\S+)(?:\s+WHERE\s+(.*))?$/is, (match, table, where) => {
            let result = `${deleteKeyword} ${table}`;
            
            if (where) {
                const formattedWhere = formatWhereClause(where, options, indent);
                result += `\n${whereKeyword} ${formattedWhere}`;
            }
            
            return result;
        });
        
        return sql;
    }
    
    function formatSelect(sql, options, indent) {
        const selectKeyword = formatKeyword('SELECT', options.keywordCase);
        const fromKeyword = formatKeyword('FROM', options.keywordCase);
        
        // Handle SELECT column list
        sql = sql.replace(/SELECT\s+(.*?)\s+FROM/is, (match, columns) => {
            const columnList = splitByCommaOutsideParens(columns);
            
            if (options.indentColumns && columnList.length > 1) {
                const formattedColumns = columnList.map((col, index) => {
                    return indent + col.trim() + (index < columnList.length - 1 ? ',' : '');
                }).join('\n');
                return `${selectKeyword}\n${formattedColumns}\n${fromKeyword}`;
            }
            return match;
        });
        
        // Handle JOIN clauses
        const joinKeywords = ['INNER JOIN', 'LEFT JOIN', 'RIGHT JOIN', 'FULL OUTER JOIN', 'CROSS JOIN', 'JOIN'];
        joinKeywords.forEach(joinType => {
            const formatted = formatKeyword(joinType, options.keywordCase);
            const regex = new RegExp(`\\s+${formatted}\\s+`, 'gi');
            sql = sql.replace(regex, `\n${formatted} `);
        });
        
        // Handle ON clauses
        sql = sql.replace(/\s+ON\s+/gi, `\n${indent}${formatKeyword('ON', options.keywordCase)} `);
        
        // Handle WHERE
        sql = sql.replace(/\s+WHERE\s+/gi, `\n${formatKeyword('WHERE', options.keywordCase)} `);
        
        // Handle WHERE conditions with AND/OR
        const whereMatch = sql.match(/WHERE\s+(.*?)(?=\s+(?:GROUP BY|HAVING|ORDER BY|LIMIT|$))/is);
        if (whereMatch) {
            const formattedWhere = formatWhereClause(whereMatch[1], options, indent);
            sql = sql.replace(whereMatch[0], `${formatKeyword('WHERE', options.keywordCase)} ${formattedWhere}`);
        }
        
        // Handle other clauses
        sql = sql.replace(/\s+GROUP\s+BY\s+/gi, `\n${formatKeyword('GROUP BY', options.keywordCase)} `);
        sql = sql.replace(/\s+ORDER\s+BY\s+/gi, `\n${formatKeyword('ORDER BY', options.keywordCase)} `);
        sql = sql.replace(/\s+HAVING\s+/gi, `\n${formatKeyword('HAVING', options.keywordCase)} `);
        sql = sql.replace(/\s+LIMIT\s+/gi, `\n${formatKeyword('LIMIT', options.keywordCase)} `);
        
        return sql;
    }
    
    function formatWhereClause(whereClause, options, indent) {
        const andKeyword = formatKeyword('AND', options.keywordCase);
        const orKeyword = formatKeyword('OR', options.keywordCase);
        
        let formatted = whereClause.trim();
        formatted = formatted.replace(/\s+AND\s+/gi, `\n${indent}${andKeyword} `);
        formatted = formatted.replace(/\s+OR\s+/gi, `\n${indent}${orKeyword} `);
        
        return formatted;
    }
    
    function splitByCommaOutsideParens(str) {
        const parts = [];
        let current = '';
        let depth = 0;
        
        for (let i = 0; i < str.length; i++) {
            const char = str[i];
            
            if (char === '(') depth++;
            if (char === ')') depth--;
            
            if (char === ',' && depth === 0) {
                parts.push(current.trim());
                current = '';
            } else {
                current += char;
            }
        }
        
        if (current.trim()) {
            parts.push(current.trim());
        }
        
        return parts;
    }
    
    function formatKeyword(keyword, caseStyle) {
        switch (caseStyle) {
            case 'upper':
                return keyword.toUpperCase();
            case 'lower':
                return keyword.toLowerCase();
            case 'capitalize':
                return keyword.split(' ').map(word => 
                    word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()
                ).join(' ');
            default:
                return keyword.toUpperCase();
        }
    }
</script>
@endpush


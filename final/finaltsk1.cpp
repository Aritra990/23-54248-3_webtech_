#include<iostream>
#include<fstream>
#include<string>
using namespace std;

int kwCnt = 0;
int valIdCnt = 0;
int invIdCnt = 0;
int numCnt = 0;
int opCnt = 0;
int cmtCnt = 0;
int unkCnt = 0;
bool isLet(char c)
{
    if((c >= 'a' && c <= 'z') || (c >= 'A' && c <= 'Z'))
        return true;
    return false;
}

bool isDig(char c)
{
    if(c >= '0' && c <= '9')
        return true;
    return false;
}

bool isSpc(char c)
{
    if(c == ' ' || c == '\t')
        return true;
    return false;
}

bool isOp(char c)
{
    if(c == '+' || c == '-' || c == '*' || c == '/' || c == '=' ||
       c == '<' || c == '>' || c == '%' || c == '!' || c == '&' ||
       c == '|' || c == '^' || c == '~')
        return true;
    return false;
}

bool isSym(char c)
{
    if(c == '(' || c == ')' || c == '{' || c == '}' ||
       c == ';' || c == ',' || c == '[' || c == ']' ||
       c == ':' || c == '?' || c == '#')
        return true;
    return false;
}

bool isKwd(string t)
{
    string kw[24] = {
        "int", "float", "double", "char", "bool", "void",
        "if", "else", "while", "for", "do", "switch", "case",
        "default", "break", "continue", "return", "const",
        "struct", "class", "true", "false", "nullptr", "sizeof"
    };
    for(int i = 0; i < 24; i = i + 1)
        if(t == kw[i])
            return true;
    return false;
}

bool isValidId(string t)
{
    int n = t.length();
    if(n == 0)
        return false;
    if(!isLet(t[0]) && t[0] != '_')
        return false;
    for(int i = 1; i < n; i = i + 1)
        if(!isLet(t[i]) && !isDig(t[i]) && t[i] != '_')
            return false;
    return true;
}

bool isValidNum(string t)
{
    int n = t.length();
    if(n == 0)
        return false;
    int dot = 0;
    for(int i = 0; i < n; i = i + 1)
    {
        if(t[i] == '.')
        {
            dot = dot + 1;
            continue;
        }
        if(!isDig(t[i]))
            return false;
    }
    if(dot > 1)
        return false;
    return true;
}

bool isInvId(string t)
{
    int n = t.length();
    if(n == 0)
        return false;
    if(!isDig(t[0]))
        return false;
    for(int i = 0; i < n; i = i + 1)
        if(isLet(t[i]) || t[i] == '_')
            return true;
    return false;
}

string extTok(string l, int s, int e)
{
    string t = "";
    for(int i = s; i < e; i = i + 1)
        t = t + l[i];
    return t;
}

string clsTok(string t)
{
    if(isKwd(t))
    {
        kwCnt = kwCnt + 1;
        return "Keyword";
    }
    if(isValidNum(t))
    {
        numCnt = numCnt + 1;
        return "Number";
    }
    if(isValidId(t))
    {
        valIdCnt = valIdCnt + 1;
        return "Valid Identifier";
    }
    if(isInvId(t))
    {
        invIdCnt = invIdCnt + 1;
        return "Invalid Identifier";
    }
    unkCnt = unkCnt + 1;
    return "Unknown Token";
}

string getMultOp(string l, int p)
{
    int n = l.length();
    if(p + 1 < n)
    {
        string two = l.substr(p, 2);
        if(two == "++" || two == "--" || two == "==" || two == "!=" ||
           two == "<=" || two == ">=" || two == "&&" || two == "||" ||
           two == "+=" || two == "-=" || two == "*=" || two == "/=" ||
           two == "%=" || two == "&=" || two == "|=" || two == "^=" ||
           two == "<<" || two == ">>" || two == "->")
            return two;
        if(p + 2 < n)
        {
            string thr = l.substr(p, 3);
            if(thr == "<<=" || thr == ">>=")
                return thr;
        }
    }
    return string(1, l[p]);
}

void procLine(string l)
{
    int n = l.length();
    int i = 0;

    while(i < n)
    {
        char c = l[i];

        if(isSpc(c))
        {
            i = i + 1;
            continue;
        }

        if(c == '"')
        {
            int s = i;
            i = i + 1;
            while(i < n && l[i] != '"')
            {
                if(l[i] == '\\' && i + 1 < n)
                    i = i + 2;
                else
                    i = i + 1;
            }
            if(i < n)
                i = i + 1;
            string t = extTok(l, s, i);
            cout << t << "  ->  String Literal" << endl;
            continue;
        }

        if(c == '\'')
        {
            int s = i;
            i = i + 1;
            while(i < n && l[i] != '\'')
            {
                if(l[i] == '\\' && i + 1 < n)
                    i = i + 2;
                else
                    i = i + 1;
            }
            if(i < n)
                i = i + 1;
            string t = extTok(l, s, i);
            cout << t << "  ->  Character Literal" << endl;
            continue;
        }

        if(c == '/' && i + 1 < n && l[i + 1] == '/')
        {
            string t = extTok(l, i, n);
            cout << t << "  ->  Comment" << endl;
            cmtCnt = cmtCnt + 1;
            i = n;
            continue;
        }

        if(c == '/' && i + 1 < n && l[i + 1] == '*')
        {
            int s = i;
            i = i + 2;
            while(i + 1 < n && !(l[i] == '*' && l[i + 1] == '/'))
                i = i + 1;
            if(i + 1 < n)
                i = i + 2;
            else
                i = n;
            string t = extTok(l, s, i);
            cout << t << "  ->  Comment" << endl;
            cmtCnt = cmtCnt + 1;
            continue;
        }

        if(isOp(c))
        {
            string op = getMultOp(l, i);
            cout << op << "  ->  Operator" << endl;
            opCnt = opCnt + 1;
            i = i + op.length();
            continue;
        }

        if(isSym(c))
        {
            string t = extTok(l, i, i + 1);
            cout << t << "  ->  Symbol" << endl;
            i = i + 1;
            continue;
        }

        if(isLet(c) || c == '_')
        {
            int s = i;
            while(i < n && (isLet(l[i]) || isDig(l[i]) || l[i] == '_'))
                i = i + 1;
            string t = extTok(l, s, i);
            cout << t << "  ->  " << clsTok(t) << endl;
            continue;
        }

        if(isDig(c))
        {
            int s = i;
            bool hasDot = false;
            while(i < n && (isDig(l[i]) || l[i] == '.'))
            {
                if(l[i] == '.')
                {
                    if(hasDot) break;
                    hasDot = true;
                }
                i = i + 1;
            }
            string t = extTok(l, s, i);
            cout << t << "  ->  " << clsTok(t) << endl;
            continue;
        }

        string t = extTok(l, i, i + 1);
        cout << t << "  ->  Unknown Token" << endl;
        unkCnt = unkCnt + 1;
        i = i + 1;
    }
}

void printSum()
{
    cout << endl;
    cout << "Summary:" << endl;
    cout << "Keywords: " << kwCnt << endl;
    cout << "Valid Identifiers: " << valIdCnt << endl;
    cout << "Invalid Identifiers: " << invIdCnt << endl;
    cout << "Numbers: " << numCnt << endl;
    cout << "Operators: " << opCnt << endl;
    cout << "Comments: " << cmtCnt << endl;
    cout << "Unknown Tokens: " << unkCnt << endl;
}

int main()
{
    string fname;
    cout << "Enter file name: ";
    getline(cin, fname);

    ifstream f(fname.c_str());

    if(!f.is_open())
    {
        cout << "Could not open file: " << fname << endl;
        return 0;
    }

    string line;
    while(getline(f, line))
    {
        procLine(line);
    }

    f.close();
    printSum();

    return 0;
}

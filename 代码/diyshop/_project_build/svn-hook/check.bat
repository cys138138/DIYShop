php E:\workspace\umfun\rebuild\yii check/check %1
:�����':'ֻҪ��ע������
:����Ŀ¼��ִ�п���̨����
:cd E:\workspace\umfun\rebuild
:e:
:php yii check/check %1

: %1 ��svn�ṩ����ʱ�ļ�·�������溬��Ҫ���µ��ļ��б�
: if�жϣ���һ����ʾ������һ��Ҫ���ڵ�һλ��������ʲôԭ�򣬻�ûʱ���Ų�

if %errorlevel% == 4 goto nothing
if %errorlevel% == 1 goto one
if %errorlevel% == 2 goto two
if %errorlevel% == 3 goto three
if %errorlevel% == 5 goto five

:nothing
echo Property '�ˣ�û������' cannot be changed >&2
exit 0
goto end

:three
:echo Property '���Ӵ��ݵ��ļ�·�������ڣ��鲻��Ҫ���µ��ļ�' cannot be changed >&2
exit 1
goto end

:one
echo '��Ҫ���µ��ļ��к��С�console.log��' >&2
exit 1
goto end

:two
echo '��Ҫ���µ��ļ���xxx���С�yii\helpers\Url��' >&2
exit 1
goto end

:five
echo 'php�ļ��﷨���� ' >&2
exit 1
goto end

:end
exit 1


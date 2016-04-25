php E:\workspace\umfun\rebuild\yii check/check %1
:这里的':'只要是注释作用
:进入目录下执行控制台命令
:cd E:\workspace\umfun\rebuild
:e:
:php yii check/check %1

: %1 是svn提供的临时文件路径，里面含有要更新的文件列表
: if判断，第一个表示正常，一定要放在第一位。具体是什么原因，还没时间排查

if %errorlevel% == 4 goto nothing
if %errorlevel% == 1 goto one
if %errorlevel% == 2 goto two
if %errorlevel% == 3 goto three
if %errorlevel% == 5 goto five

:nothing
echo Property '嗨，没问题亲' cannot be changed >&2
exit 0
goto end

:three
:echo Property '钩子传递的文件路径不存在，查不到要更新的文件' cannot be changed >&2
exit 1
goto end

:one
echo '你要更新的文件中含有“console.log”' >&2
exit 1
goto end

:two
echo '你要更新的文件中xxx含有“yii\helpers\Url”' >&2
exit 1
goto end

:five
echo 'php文件语法错误 ' >&2
exit 1
goto end

:end
exit 1


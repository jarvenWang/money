var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var reload      = browserSync.reload;          //服务器和监听文件,自动刷新
var uglify = require('gulp-uglify');                 // js 压缩
var minifycss = require('gulp-minify-css');  //css 压缩
var imagemin = require('gulp-imagemin');  //图片压缩
var clean = require('gulp-clean');                 //清除文件
var runSequence = require('run-sequence');   //控制任务执行顺序
var rev = require('gulp-rev');                      //生成md5
var revCollector = require('gulp-rev-collector');//html替换文件路径加md5
var revReplace = require('gulp-rev-replace');
var useref = require('gulp-useref');    //html中文件路径合并
var concat = require('gulp-concat');    //文件合并
var del = require('del');  //删除文件
var vinylPaths = require('vinyl-paths');
var gulpif = require('gulp-if');
var autoprefixer = require('gulp-autoprefixer');  //css 前缀自动补全
var prettify = require('gulp-html-prettify');    //html 文件格式化
var htmlminify = require("gulp-html-minify");     //html 压缩
//路径定义
var cssSrc = 'src/styles/*.css',
    cssDest = 'dist/styles',
    htmlSrc = 'src/views/*',
    htmlDest = 'dist/views',
    widgetSrc = 'src/bower_components/**',
    widgetDest = 'dist/bower_components/',
    jsSrc = 'src/scripts/*.js',
    jsDest = 'dist/scripts',
    fontSrc = 'src/fonts/*',
    fontDest = 'dist/font',
    imgSrc = 'src/images/*',
    imgDest = 'dist/images',
    cssRevSrc = 'src/styles/revCss',
    jsRevSrc = 'src/scripts/revjs',
    condition = true;


//清除文件,避免资源冗余
gulp.task('clean',function(){ 
    return gulp.src('dist', {read: false})
    .pipe(clean());
})


/*css 文件压缩，更改版本号*/
gulp.task('minifycss',function(){
    return  gulp.src(cssSrc)
        .pipe(autoprefixer())
        .pipe(concat("main.css"))
        .pipe(minifycss())
        .pipe(rev())
        .pipe(gulp.dest(cssDest))
        .pipe(rev.manifest())
        .pipe(gulp.dest('dist/rev/css'));
})

/*js 文件压缩，更改版本号*/
gulp.task('uglify', function () {
    return gulp.src('src/scripts/*/*.js')
        .pipe(concat("main.js"))
        .pipe(uglify())
        .pipe(rev())
        .pipe(gulp.dest(jsDest))
        .pipe(rev.manifest())
        .pipe(gulp.dest('dist/rev/js'))
})


//图片 压缩
gulp.task('imagemin',function(){
    gulp.src(imgSrc)
    .pipe(imagemin({
    optimizationLevel: 5, //类型：Number  默认：3  取值范围：0-7（优化等级）
            progressive: true, //类型：Boolean 默认：false 无损压缩jpg图片
            interlaced: true, //类型：Boolean 默认：false 隔行扫描gif进行渲染
            multipass: true //类型：Boolean 默认：false 多次优化svg直到完全优化
        }))
    .pipe(gulp.dest(imgDest))
})

//bower_components组件输出
gulp.task('widgetout',function(){
    gulp.src(widgetSrc)
    .pipe(gulp.dest(widgetDest))
})

//通过hash来精确定位到html模板中需要更改的部分,然后将修改成功的文件生成到指定目录
gulp.task('rev',function(){
    return gulp.src(['dist/rev/**/*.json','src/*.html'])
        .pipe(useref())    //useref只合并，不压缩
        .pipe(gulpif('*.js', uglify()))
        .pipe(gulpif('*.css', minifycss()))
        .pipe( revCollector() )
        .pipe(gulp.dest('dist/'));
});

//html输出
gulp.task('html',function(){
    gulp.src('src/views/*.html')
    .pipe(htmlminify())
    .pipe(gulp.dest('dist/views'));
})
gulp.task('htmlIndex',function(){
    gulp.src('src/*.html')
        .pipe(useref())
        .pipe(prettify({indent_char: ' ', indent_size: 4}))
        .pipe(htmlminify())
        .pipe(gulp.dest('dist/'));
})
/**
问题描述:  useref 合并路径后输出到dist下面，而不是views下面（直接输出到views下面script，style都在views下面）
暂时解决方案： 将dist下面的html在输出一次到views下面
 */
/*gulp.task('changHtml',function(){
    gulp.src('dist/*.html')
        .pipe( vinylPaths(del))
        .pipe(gulp.dest('dist/views'));
})*/


//删除生成版本的json文件
gulp.task('delRev', function () {
  return gulp.src('dist/rev')
    .pipe(vinylPaths(del));
});


// 命令说明
gulp.task('help',function () {
    console.log('   gulp build          文件打包');
    console.log('   gulp clean          清空生产环境或开发环境所有文件');
    console.log('   gulp help           gulp命令参数说明');
    console.log('   gulp defalut       测试serve');
    console.log('   gulp serve         启动服务器和监听文件');
});

//构建项目
/**
 * [description]
 * @param  {[revCollectorFile]}     加版本号替换文件注意执行顺序
 */
gulp.task('build', function(callback) {
  runSequence('clean',
              ['minifycss','uglify','imagemin','widgetout','html'],['rev'],['delRev'],
              callback);
});


// 静态服务器 + 监听 scss/html 文件
gulp.task('serve', function() {

    browserSync.init({
         server: {
            baseDir: "./src"
        }
    });
    gulp.watch("src/views/*.html").on('change', reload);
    gulp.watch("src/styles/*.css").on('change', reload);
    gulp.watch("src/scripts/*.js").on('change', reload);
 
});

//启动静态服务器和舰艇文件
gulp.task('defalut', ['serve']);
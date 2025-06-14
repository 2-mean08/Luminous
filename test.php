<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Custom Phone Case Designer</title>
    <style>
        #case {
            width: 300px;
            height: 600px;
            background-color: lightgray;
            position: relative;
            margin: 20px auto;
            border-radius: 20px;
            overflow: hidden;
        }

        .image-container {
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            transform-origin: center;
            cursor: grab;
        }

        .uploaded-image {
            display: block;
            max-width: 100%;
            max-height: 100%;
        }

        .selected {
            outline: 2px solid red;
        }

        .resize-handle {
            width: 10px;
            height: 10px;
            background-color: blue;
            position: absolute;
            cursor: nwse-resize;
        }

        .resize-handle.tl {
            top: 0;
            left: 0;
            transform: translate(-50%, -50%);
        }

        .resize-handle.tr {
            top: 0;
            right: 0;
            transform: translate(50%, -50%);
        }

        .resize-handle.bl {
            bottom: 0;
            left: 0;
            transform: translate(-50%, 50%);
        }

        .resize-handle.br {
            bottom: 0;
            right: 0;
            transform: translate(50%, 50%);
        }

        .rotate-handle {
            width: 15px;
            height: 15px;
            background-color: green;
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            cursor: pointer;
            border-radius: 50%;
        }

        .delete-button,
        .copy-button {
            position: absolute;
            top: -40px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
            padding: 5px;
            font-size: 12px;
        }

        .copy-button {
            left: 0;
            background-color: orange;
        }

        .delete-button {
            right: 0;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <h1>Custom Phone Case Designer</h1>
    <div id="case"></div>
    <input type="file" id="imageInput" accept="image/*" />

    <script>
        const caseElement = document.getElementById('case');
        const imageInput = document.getElementById('imageInput');

        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    createImage(e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

function createImage(src, posX = 50, posY = 50, width = 100, height = 100, rotation = 0) {
    // 컨테이너 요소 생성 (DB: custom_images 테이블 레코드에 해당)
    const container = document.createElement('div');
    container.className = 'image-container';
    container.style.width = `${width}px`;  // DB: width 컬럼
    container.style.height = `${height}px`; // DB: height 컬럼

    // 상태 변수 초기화
    let rotationAngle = rotation; // DB: rotation 컬럼 (0~360)
    let currentX = posX;          // DB: pos_x (픽셀 → 비율 변환 필요)
    let currentY = posY;          // DB: pos_y (픽셀 → 비율 변환 필요)

    // 이미지 요소 생성 및 속성 설정
    const img = document.createElement('img');
    img.src = src;                // DB: image_url 컬럼
    img.className = 'uploaded-image';
    container.appendChild(img);

    // 삭제 버튼 설정 (DB 연동 필요 없음)
    const deleteButton = document.createElement('button');
    deleteButton.className = 'delete-button hidden';
    deleteButton.textContent = 'Delete';
    container.appendChild(deleteButton);

    // 복사 버튼 설정 (DB: design_id 관리 필요)
    const copyButton = document.createElement('button');
    copyButton.className = 'copy-button hidden';
    copyButton.textContent = 'Copy';
    container.appendChild(copyButton);

    // 회전 핸들 생성 (DB: rotation 컬럼 업데이트)
    const rotateHandle = document.createElement('div');
    rotateHandle.className = 'rotate-handle hidden';
    container.appendChild(rotateHandle);

    // 리사이즈 핸들 생성 (4방향)
    ['tl', 'tr', 'bl', 'br'].forEach(handle => {
        const resizeHandle = document.createElement('div');
        resizeHandle.className = `resize-handle ${handle} hidden`;
        container.appendChild(resizeHandle);

        // 리사이즈 이벤트 핸들러 (DB: width/height/pos_x/pos_y 업데이트)
        resizeHandle.addEventListener('mousedown', function(ev) {
            ev.preventDefault();
            ev.stopPropagation();
            
            // 초기 위치 정보 저장
            const rect = container.getBoundingClientRect();
            const caseRect = caseElement.getBoundingClientRect();
            const initWidth = rect.width;     // DB: width
            const initHeight = rect.height;   // DB: height
            
            // 마우스 이동 처리
            function onMouseMove(e) {
                const deltaX = e.clientX - ev.clientX;
                const deltaY = e.clientY - ev.clientY;

                // 리사이즈 계산 로직
                let newWidth = initWidth + deltaX * (handle.includes('r') ? 1 : -1);
                let newHeight = initHeight + deltaY * (handle.includes('b') ? 1 : -1);

                // Shift 키: 종횡비 유지 (DB: scale_x/scale_y 자동 계산)
                if (e.shiftKey) {
                    const aspectRatio = initWidth / initHeight;
                    newHeight = newWidth / aspectRatio;
                }

                // 최소 크기 제한
                newWidth = Math.max(30, newWidth);
                newHeight = Math.max(30, newHeight);

                // 위치 재계산 (DB: pos_x/pos_y)
                currentX = rect.left - caseRect.left + (handle.includes('l') ? initWidth - newWidth : 0);
                currentY = rect.top - caseRect.top + (handle.includes('t') ? initHeight - newHeight : 0);

                // UI 업데이트
                container.style.width = `${newWidth}px`;
                container.style.height = `${newHeight}px`;
                container.style.transform = `translate(${currentX}px, ${currentY}px) rotate(${rotationAngle}deg)`;
            }

            // 이벤트 리스너 정리
            function onMouseUp() {
                document.removeEventListener('mousemove', onMouseMove);
                document.removeEventListener('mouseup', onMouseUp);
                saveToDatabase(); // DB 저장 함수 호출
            }

            document.addEventListener('mousemove', onMouseMove);
            document.addEventListener('mouseup', onMouseUp);
        });
    });

    // 회전 이벤트 핸들러 (DB: rotation 컬럼 업데이트)
    rotateHandle.addEventListener('mousedown', function(ev) {
        ev.preventDefault();
        const centerX = container.offsetLeft + container.offsetWidth/2;
        const centerY = container.offsetTop + container.offsetHeight/2;
        let startAngle = Math.atan2(ev.clientY - centerY, ev.clientX - centerX);

        function onMouseMove(e) {
            const currentAngle = Math.atan2(e.clientY - centerY, e.clientX - centerX);
            rotationAngle += (currentAngle - startAngle) * (180 / Math.PI);
            container.style.transform = `translate(${currentX}px, ${currentY}px) rotate(${rotationAngle}deg)`;
            startAngle = currentAngle;
        }

        function onMouseUp() {
            document.removeEventListener('mousemove', onMouseMove);
            document.removeEventListener('mouseup', onMouseUp);
            saveToDatabase(); // DB 저장 함수 호출
        }

        document.addEventListener('mousemove', onMouseMove);
        document.addEventListener('mouseup', onMouseUp);
    });

    // 이동 이벤트 핸들러 (DB: pos_x/pos_y 업데이트)
    container.addEventListener('mousedown', function(ev) {
        if (ev.target.closest('.resize-handle, .rotate-handle')) return;

        const startX = ev.clientX - currentX;
        const startY = ev.clientY - currentY;

        function onMouseMove(e) {
            currentX = e.clientX - startX;
            currentY = e.clientY - startY;
            container.style.transform = `translate(${currentX}px, ${currentY}px) rotate(${rotationAngle}deg)`;
        }

        function onMouseUp() {
            document.removeEventListener('mousemove', onMouseMove);
            document.removeEventListener('mouseup', onMouseUp);
            saveToDatabase(); // DB 저장 함수 호출
        }

        document.addEventListener('mousemove', onMouseMove);
        document.addEventListener('mouseup', onMouseUp);
    });

    // DB 저장 함수
    function saveToDatabase() {
        const designData = {
            image_url: src,
            file_name: src.split('/').pop(),
            pos_x: currentX / caseElement.offsetWidth,  // 픽셀 → 비율 변환
            pos_y: currentY / caseElement.offsetHeight,
            width: container.offsetWidth,
            height: container.offsetHeight,
            rotation: rotationAngle % 360,
            original_width: img.naturalWidth,  // 원본 너비
            original_height: img.naturalHeight // 원본 높이
        };

        // PHP API 호출
        fetch('/api/save-design', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(designData)
        });
    }

    // 초기 위치 설정
    container.style.transform = `translate(${currentX}px, ${currentY}px) rotate(${rotationAngle}deg)`;
    caseElement.appendChild(container);
}
    </script>
</body>

</html>
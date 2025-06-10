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
            const container = document.createElement('div');
            container.className = 'image-container';
            container.style.width = width + 'px';
            container.style.height = height + 'px';

            let rotationAngle = rotation;
            let currentX = posX;
            let currentY = posY;

            const img = document.createElement('img');
            img.src = src;
            img.className = 'uploaded-image';
            container.appendChild(img);

            const deleteButton = document.createElement('button');
            deleteButton.className = 'delete-button hidden';
            deleteButton.textContent = 'Delete';
            container.appendChild(deleteButton);

            const copyButton = document.createElement('button');
            copyButton.className = 'copy-button hidden';
            copyButton.textContent = 'Copy';
            container.appendChild(copyButton);

            const rotateHandle = document.createElement('div');
            rotateHandle.className = 'rotate-handle hidden';
            container.appendChild(rotateHandle);

            ['tl', 'tr', 'bl', 'br'].forEach(handle => {
                const resizeHandle = document.createElement('div');
                resizeHandle.className = `resize-handle ${handle} hidden`;
                container.appendChild(resizeHandle);

                resizeHandle.addEventListener('mousedown', function(ev) {
                    ev.preventDefault();
                    ev.stopPropagation();
                    const rect = container.getBoundingClientRect();
                    const caseRect = caseElement.getBoundingClientRect();
                    const initWidth = rect.width;
                    const initHeight = rect.height;
                    const initX = ev.clientX;
                    const initY = ev.clientY;

                    const originX = handle.includes('l') ? rect.right : rect.left;
                    const originY = handle.includes('t') ? rect.bottom : rect.top;
                    const offsetX = originX - rect.left;
                    const offsetY = originY - rect.top;

                    function onMouseMove(e) {
                        const deltaX = e.clientX - initX;
                        const deltaY = e.clientY - initY;

                        let scaleX = handle.includes('l') ? -1 : 1;
                        let scaleY = handle.includes('t') ? -1 : 1;

                        let newWidth = initWidth + deltaX * scaleX;
                        let newHeight = initHeight + deltaY * scaleY;

                        // Shift 누르면 비율 유지
                        if (e.shiftKey) {
                            const aspectRatio = initWidth / initHeight;
                            if (Math.abs(deltaX) > Math.abs(deltaY)) {
                                newWidth = initWidth + deltaX * scaleX;
                                newHeight = newWidth / aspectRatio;
                            } else {
                                newHeight = initHeight + deltaY * scaleY;
                                newWidth = newHeight * aspectRatio;
                            }
                        }

                        newWidth = Math.max(30, newWidth);
                        newHeight = Math.max(30, newHeight);

                        // 이동 보정 (기준점 유지)
                        const offsetX = (handle.includes('l') ? 1 : 0);
                        const offsetY = (handle.includes('t') ? 1 : 0);

                        const newLeft = originX - newWidth * offsetX;
                        const newTop = originY - newHeight * offsetY;
                        currentX = newLeft - caseRect.left;
                        currentY = newTop - caseRect.top;

                        container.style.width = `${newWidth}px`;
                        container.style.height = `${newHeight}px`;
                        container.style.transform = `translate(${currentX}px, ${currentY}px) rotate(${rotationAngle}deg)`;
                    }



                    function onMouseUp() {
                        document.removeEventListener('mousemove', onMouseMove);
                        document.removeEventListener('mouseup', onMouseUp);
                    }

                    document.addEventListener('mousemove', onMouseMove);
                    document.addEventListener('mouseup', onMouseUp);
                });
            });

            container.addEventListener('click', function(ev) {
                ev.stopPropagation();
                document.querySelectorAll('.image-container').forEach(c => {
                    c.classList.remove('selected');
                    c.querySelectorAll('.resize-handle').forEach(h => h.classList.add('hidden'));
                    c.querySelector('.delete-button').classList.add('hidden');
                    c.querySelector('.copy-button').classList.add('hidden');
                    c.querySelector('.rotate-handle').classList.add('hidden');
                });
                container.classList.add('selected');
                container.querySelectorAll('.resize-handle').forEach(h => h.classList.remove('hidden'));
                deleteButton.classList.remove('hidden');
                copyButton.classList.remove('hidden');
                rotateHandle.classList.remove('hidden');
            });

            deleteButton.addEventListener('click', () => {
                caseElement.removeChild(container);
            });

            copyButton.addEventListener('click', () => {
                createImage(
                    src,
                    currentX + 20,
                    currentY + 20,
                    container.offsetWidth,
                    container.offsetHeight,
                    rotationAngle
                );
            });

            rotateHandle.addEventListener('mousedown', function(ev) {
                ev.preventDefault();
                const rect = container.getBoundingClientRect();
                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;
                let startAngle = Math.atan2(ev.clientY - centerY, ev.clientX - centerX);

                function onMouseMove(e) {
                    const currentAngle = Math.atan2(e.clientY - centerY, e.clientX - centerX);
                    const angleDelta = currentAngle - startAngle;
                    rotationAngle += angleDelta * (180 / Math.PI);
                    container.style.transform = `translate(${currentX}px, ${currentY}px) rotate(${rotationAngle}deg)`;
                    startAngle = currentAngle;
                }

                function onMouseUp() {
                    document.removeEventListener('mousemove', onMouseMove);
                    document.removeEventListener('mouseup', onMouseUp);
                }

                document.addEventListener('mousemove', onMouseMove);
                document.addEventListener('mouseup', onMouseUp);
            });

            container.addEventListener('mousedown', function(ev) {
                if (
                    ev.target.classList.contains('resize-handle') ||
                    ev.target.classList.contains('rotate-handle')
                ) return;

                if (!container.classList.contains('selected')) return;

                const rect = container.getBoundingClientRect();
                const clickX = ev.clientX - rect.left;
                const clickY = ev.clientY - rect.top;

                function onMouseMove(e) {
                    const rect = caseElement.getBoundingClientRect();
                    currentX = e.clientX - rect.left - clickX;
                    currentY = e.clientY - rect.top - clickY;
                    container.style.transform = `translate(${currentX}px, ${currentY}px) rotate(${rotationAngle}deg)`;
                }

                function onMouseUp() {
                    document.removeEventListener('mousemove', onMouseMove);
                    document.removeEventListener('mouseup', onMouseUp);
                }

                document.addEventListener('mousemove', onMouseMove);
                document.addEventListener('mouseup', onMouseUp);
            });

            container.addEventListener('dragstart', e => e.preventDefault());

            container.style.transform = `translate(${currentX}px, ${currentY}px) rotate(${rotationAngle}deg)`;
            caseElement.appendChild(container);
        }

        document.addEventListener('click', function() {
            document.querySelectorAll('.image-container').forEach(c => {
                c.classList.remove('selected');
                c.querySelectorAll('.resize-handle').forEach(h => h.classList.add('hidden'));
                c.querySelector('.delete-button').classList.add('hidden');
                c.querySelector('.copy-button').classList.add('hidden');
                c.querySelector('.rotate-handle').classList.add('hidden');
            });
        });
    </script>
</body>

</html>